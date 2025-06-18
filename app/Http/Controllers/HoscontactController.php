<?php

namespace App\Http\Controllers;

use App\Models\Hoscontact;
use App\Models\Information;
use App\Models\Seeting;
use Illuminate\Http\Request;

class HoscontactController extends Controller
{
    public function index(){
        $info = Information::first();
        if (!$info) {
            $info = new Information();
            $info->address = 'No address set';
            $info->latitude = '0';
            $info->longitude = '0';
        }
        $setting = Seeting::first();
        if (!$setting) {
            $map = new Seeting();
            $map->address = 'No address set';
            $map->latitude = '0';
            $map->longitude = '0';
        }
        return view('landing.hospitalcontact', compact('setting', 'info'));
    }
    public function store(Request $request){
        //validate the request
        $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|max:255',
           
            'message' => 'required|string|max:500',
        ]);

        //store the contact message in the database
        // Assuming you have a Contact model and a contacts table
        Hoscontact::create([
            'name' => $request->name,
            'email' => $request->email,
            'messgae' => $request->message,
        ]);
        //redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
