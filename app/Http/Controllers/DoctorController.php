<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
       public function home()
    {
        return view('doctor.doctordashboard');
    }
    public function doctorprofile()
    {
        $departments = Department::all(); // latest first + pagination
        return view('doctor.doctorprofile', compact('departments'));
    }


}
