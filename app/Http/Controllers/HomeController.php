<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
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
    public function doctorprofile()
    {

        return view('landing.doctor');
    }
    public function doctorprofileview($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('landing.doctor-profile', compact('doctor'));
    }

    public function insertAppointment(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|',
            'phone' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'address' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'time' => 'required',

            'doctor_id' => 'required|exists:doctors,user_id',
            'date' => 'required|date',
            'fee' => 'required|numeric',
        ]);



        Appointment::create([
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

        return redirect()->back()->with('msg', 'Appointment added successfully');
    }
}
