<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showform(){
        return view('admin.applyadmin');
    }

    public function submitform(Request $request){
        $request->validate([
             'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,doctor,receptionist',
            'phone'    => 'required|digits_between:10,15',
            'photo'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
       
        // Save Image
        $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('dp'), $photoName);

        // Create User
        User::create([
               'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role,
            'phone'    => $request->phone,
            'photo'    => 'dp/' . $photoName,

        ]);
         return redirect()->route('auth.login')->with('success', 'User registered successfully!');

    }
    public function adminDashboard(){
        return view('admin.adminDashboard');
    }

}
