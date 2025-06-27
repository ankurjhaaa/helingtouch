<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $doctors = User::where('role', 'doctor')->get();
        return view('landing.home', compact('doctors'));
    }
    public function appointment()
    {
        $departments = Department::all(); // latest first + pagination
        $doctors = User::where('role', 'doctor')->get();
        return view('landing.appointment', compact('departments', 'doctors'));
    }
    public function manageappointments()
    {
        $allappointments = Appointment::all();
        return view('landing.manage-appointments', compact('allappointments'));
    }
    public function successappointment()
    {
        return view('landing.success-appointment');
    }
    public function appointmentrecipt()
    {
        return view('landing.appointmentrecipt');
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

        // Redirect to confirmation page with session data
        return redirect()->route('successappointment')->with('appointment', $appointment);
    }

    public function ourGallery()
    {
        $galleryItems = Gallery::latest()->get();
        return view('landing.our-gallery', compact('galleryItems'));
    }
}
