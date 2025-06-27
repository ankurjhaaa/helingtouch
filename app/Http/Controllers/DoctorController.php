<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\History;
use App\Models\Leave;
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
        return view('doctor.patient', compact('patientappointdetail'));
    }

    public function markCompleted($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);

        $appointment->status = 'completed';
        $appointment->save();

        return back()->with('success', 'Appointment marked as completed.');
    }
    public function showLeaveForm()
    {
        $doctor = auth()->user()->doctor; // Assuming the user is authenticated and has a doctor profile
        $leaves = Leave::where('doctor_id', $doctor->id)->orderByDesc('leave_date')->get();

        return view('doctor.leave-form', compact('leaves'));
    }
    public function submitLeave(Request $request)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'reason' => 'nullable|string|max:255',
        ]);

        Leave::create([
            'doctor_id' => auth()->user()->doctor->id, // Assuming the user is authenticated and has a doctor profile
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
            'status' => 'pending', // Default status
        ]);
        return back()->with('success', 'Leave applied successfully. Waiting for admin approval.');
    }

    public function insertuserhistory(Request $request)
    {
        $request->validate([
            'chat' => 'required',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('dp', 'public');
        }
        History::create([
            'chat' => $request->chat,
            'doctorid' => $request->doctorid,
            'useremail' => $request->useremail,
            'image' => $imagePath,
        ]);
        return back();
    }


}
