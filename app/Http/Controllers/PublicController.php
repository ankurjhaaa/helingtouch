<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function home()
    {
        return view('landing.public-registration');
    }

    public function userregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users|email:rfc,dns',
            'phone' => [
                'required',
                'numeric',
                'unique:users,phone',
                'regex:/^(\+91[\-\s]?)?[0]?(91)?[6-9]\d{9}$/'
            ],
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,

        ]);
        Auth::login($user);

        return redirect()->route('user.Apointment')->with('success', 'Registration successful! You are now logged in.');
    }
    public function showLogin(){
        return view('landing.userlogin');

    }
    public function userLogin(Request $request){
          $credentials = $request->only('email', 'password');
          if(Auth::attempt(array_merge($credentials, ['role' => 'user']))){
           return redirect()->route('userappointment');
          }
           return back()->withErrors(['email' => 'Invalid credentials']);

    }

    public function userApointment(){
        return view('landing.user-apointment');
    }

    

}
