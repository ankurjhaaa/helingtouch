<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
       
        $doctors = User::where('role', 'doctor')->get();
        return view('landing.home', compact('doctors'));
    }
    public function appointment(){
       
        return view('landing.appointment');
    }
    public function bookAppointment(){
       
        return view('landing.book-appointment');
    }
   
}
