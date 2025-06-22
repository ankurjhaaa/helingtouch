<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $creadentials = $request->only('email', 'password');

        if (Auth::attempt($creadentials)){
            $user = Auth::user();
                 

            if($user->role === 'admin'){
                return redirect()->route('admin.Dashboard')->with('success', 'Welcome Admin!');
            }elseif($user->role === 'doctor'){
                return redirect()->route('doctor.dashboard')->with('success', 'Welcome Doctor!');
            }elseif($user->role === 'receptionist'){
                return redirect()->route('receptionist.Dashboard')->with('success', 'Welcome Receptionist!');
            }
            else{
                return redirect()->route('home')->with('error', 'Unauthorized access!');
            }

        }
    }
      public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
