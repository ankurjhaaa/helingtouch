<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function home(){
        return view('doctor.doctorDashboard');
    }
    public function doctorprofile(){
        return view('doctor.doctorprofile');
    }
}
