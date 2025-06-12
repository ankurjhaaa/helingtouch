<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function land(){
        return view('reception.receptionDashboard');
    }
    public function recptionprofile(){
        return view('reception.receptionprofile');
    }
}
