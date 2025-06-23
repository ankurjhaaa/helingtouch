<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function home()
    {
        $appointments = Appointment::where('status', 'checked_in')
            ->where('doctor_id', auth()->id())
            ->get();
        return view('doctor.doctordashboard', compact('appointments'));
    }
    public function doctorprofile()
    {
        $departments = Department::all(); // latest first + pagination
        return view('doctor.doctorprofile', compact('departments'));
    }
    public function patient($id)
    {
        $patientappointdetail = Appointment::findOrFail($id);
        return view('doctor.patient',compact('patientappointdetail'));
    }

    public function markCompleted($id)
{
    $appointment = \App\Models\Appointment::findOrFail($id);

    $appointment->status = 'completed';
    $appointment->save();

    return back()->with('success', 'Appointment marked as completed.');
}



}
