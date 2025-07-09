<?php

namespace App\Http\Controllers;

use App\Events\AppointmentCreated;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\History;
use App\Models\Revenue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {

        $doctors = User::where('role', 'doctor')->get();
        return view('landing.home', compact('doctors'));
    }
    public function appointment()
    {
        $departments = Department::all();
        $doctors = User::where('role', 'doctor')->get();
        return view('landing.appointment', compact('departments', 'doctors'));
    }
    public function manageappointments(Request $request)
    {
        $allappointments = collect();

        if ($request->has('findappointment')) {
            $search = $request->input('findappointment');

            $allappointments = Appointment::where('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->get();
        }

        return view('landing.manage-appointments', compact('allappointments'));
    }

    public function insertotp($id)
    {
        $otp = mt_rand(1111, 9999);
        $appoint = Appointment::findOrFail($id);
        $user = User::where('email', $appoint->email)->firstOrFail();
        $user->remember_token = $otp;
        $user->save();
        Mail::raw("Dear {$appoint->name}, your appointment Requested to process to cancle ,, if you want cancle this appoint ment fill this otp ->>  {$otp}  <<- Thank you!", function ($message) use ($appoint) {
            $message->to($appoint->email)
                ->subject('Appointment Cancle');
        });
        return redirect()->back()->with('success', $id);
    }
    public function verifyotp($id, Request $request)
    {
        $verifyappoint = Appointment::findOrFail($id);
        $verifyuser = User::where('email', $verifyappoint->email)->firstOrFail();

        $otpFromDB = $verifyuser->remember_token;

        $enteredOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

        if ($enteredOtp == $otpFromDB) {
            $verifyappoint->status = 'cancelled';
            $verifyappoint->save();
            return redirect()->back()->with('successs', 'Your Appointment Is Cancelled');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }


    public function successappointment()
    {
        return view('landing.success-appointment');
    }
    public function appointmentrecipt()
    {
        return view('landing.appointmentrecipt');
    }
    public function services()
    {
        return view('landing.services');
    }



    public function bookAppointment($id)
    {
        $doctor = Doctor::with('user')->where('user_id', $id)->firstOrFail();
        $doctorprofile = User::where('id', $id)->firstOrFail();
        return view('landing.book-appointment', compact('doctor', 'doctorprofile'));
    }

    public function alldoctor()
    {

        $doctors = Doctor::with(['user'])->get();
        return view('landing.our-doctor', compact('doctors'));
    }
    public function doctorprofile($id)
    {


        $doctor = Doctor::with('user')->where('user_id', $id)->firstOrFail();

        return view('landing.doctor', compact('doctor'));
    }
    public function doctorprofileview($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('landing.doctor-profile', compact('doctor'));
    }

    public function insertAppointment(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'gender' => ['required'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'address' => ['required', 'string', 'max:500'],
            'pincode' => ['required', 'digits:6'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'time' => ['required'],

            'doctor_id' => ['required', 'exists:doctors,user_id'],
            'date' => ['required', 'date'],
            'fee' => ['required', 'numeric'],
        ]);
        $appointment = Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'message' => $request->message,
            'time' => $request->time,

            'fee' => $request->fee,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,

        ]);
        History::create([
            'chat' => $appointment->id,
            'doctorid' => '0',
            'useremail' => $request->email,
        ]);
        Revenue::create([
            'amount' => $appointment->fee,
            'email' => $appointment->email,
            'status' => 'success',
            'paymenttype' => 'debit',
            'paymentid' => 'ertryvgbhnj',
            'paymentmode' => 'online',
            'description' => 'ezdxrcfgvhbjkn',
        ]);

        // ✅ If user doesn't exist, create one
        $user = User::where('email', $request->email)->first();
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 'user',
                'password' => $password,

            ]);
            Mail::raw("Dear {$appointment->name}, your appointment for {$appointment->date} at {$appointment->time} has been confirmed. Please Check Your Appointment To Login healingtouch  ,, Your ID is {$appointment->email} And Yoyr Password Is {$password} Thank you!", function ($message) use ($appointment) {
                $message->to($appointment->email)
                    ->subject('Appointment Confirmation');
            });
        } else {
            Mail::raw("Dear {$appointment->name}, your appointment for {$appointment->date} at {$appointment->time} has been confirmed. Thank you!", function ($message) use ($appointment) {
                $message->to($appointment->email)
                    ->subject('Appointment Confirmation');
            });
        }

        // 🔴 Add this line just after appointment create
        broadcast(new AppointmentCreated($appointment))->toOthers();

        // Redirect to confirmation page with session data
        return redirect()->route('successappointment')->with('appointment', $appointment);
    }

    public function ourGallery()
    {
        $galleryItems = Gallery::latest()->get();
        return view('landing.our-gallery', compact('galleryItems'));
    }

    public function myappointment()
    {

        $useremail = Auth::user()->email;

        $allappointments = Appointment::where('email', "$useremail")->get();


        return view('landing.myappointment', compact('allappointments'));
    }
}
