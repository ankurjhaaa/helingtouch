<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserappointmentController extends Controller
{
    public function UserAppointment(){
        return view('landing.user-apointment');
    }
    public function userdashboard(){
        return view('landing.userdashboard');
    }
}
