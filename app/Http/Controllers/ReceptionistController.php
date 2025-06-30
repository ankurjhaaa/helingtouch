<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Attendance;
use App\Models\Doctor;
use App\Models\History;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function land()
    {
        $doctors = User::where('role', 'doctor')->get();

        $appointments = Appointment::with('doctor') // ← Yeh line add kari
            ->whereDate('date', Carbon::today())
            ->orderBy('id', 'desc')
            ->get();

        $todaypatient = Appointment::whereDate('date', Carbon::today())->count();

        $completedappointment = Appointment::whereDate('date', Carbon::today())
            ->where('status', 'completed')
            ->count();

        $unpaidToday = Appointment::whereDate('date', Carbon::today())
            ->where('ispaid', 0)
            ->count();

        return view('reception.receptionDashboard', compact('doctors', 'appointments', 'todaypatient', 'completedappointment', 'unpaidToday'));
    }


    public function recptionprofile()
    {
        return view('reception.receptionprofile');
    }
    public function attendance()
    {
        $allworkers = Staff::all();
        return view('reception.attendance', compact('allworkers'));
    }
    public function makeattendance(Request $request)
    {
        $request->validate([
            'staffid' => 'required',
            'attmaker' => 'required',
        ]);
        Attendance::create([
            'staffid' => $request->staffid,
            'attmaker' => $request->attmaker,
        ]);
        return back()->with('success','Attendence successfully done');

    }

    public function addappointment($id)
    {
        $doctor = Doctor::with('user')->where('user_id', $id)->firstOrFail();
        $doctorprofile = User::where('id', $id)->firstOrFail();
        return view('reception.addappointment', compact('doctor', 'doctorprofile'));
    }
    public function insertAppointment(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'], // भारतीय मोबाइल नंबर pattern
            'gender' => ['required'], // fix accepted values
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'address' => ['required', 'string', 'max:500'],
            'pincode' => ['required', 'digits:6'], // भारत का 6-digit PIN code
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
            'ispaid' => 0,
            'status' => 'approved',

        ]);

        History::create([
            'chat' => $appointment->id,
            'doctorid' => '0',
            'useremail' => $request->email,
        ]);

        // Redirect to confirmation page with session data
        return redirect()->route('successappointment')->with('appointment', $appointment);
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment approved successfully!');
    }
    public function markInProgress($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'in_progress';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment marked as In Progress!');
    }

    public function markCheckedIn($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'checked_in';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment marked as Checked-In!');
    }

    public function markCompleted($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment marked as Completed!');
    }

    public function markPaid($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->ispaid = 1;
        $appointment->save();

        return redirect()->back()->with('success', 'Payment marked successfully!');
    }
    public function resedule($id, Request $request)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rescheduled';
        $appointment->date = $request->date;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment rescheduled marked as Completed!');
    }

}
