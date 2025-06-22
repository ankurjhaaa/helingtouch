<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function land(){
        $doctors = User::where('role', 'doctor')->get();
        return view('reception.receptionDashboard', compact('doctors'));
    }
   
    public function recptionprofile(){
        return view('reception.receptionprofile');
    }

    public function addappointment($id)
    {
        $doctor = Doctor::with('user')->where('user_id', $id)->firstOrFail();
        $doctorprofile = User::where('id', $id)->firstOrFail();
        return view('reception.addappointment', compact('doctor', 'doctorprofile'));
    }
}
