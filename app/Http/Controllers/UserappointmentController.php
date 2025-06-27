<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserappointmentController extends Controller
{
    public function dashboard()
    {
        return view('landing.dashboard');
    }
    public function userhistory()
    {

        $userchats = History::where('useremail', Auth::user()->email)->orderBy('created_at', 'desc')->get();

        return view('landing.userhistory', compact('userchats'));
    }
    public function insertuserhistory(Request $request)
    {
        $request->validate([
            'chat' => 'required',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('dp', 'public');
        }
        History::create([
            'chat' => $request->chat,
            'image' => $imagePath,
            'useremail' => Auth::user()->email,
        ]);


        return redirect()->back()->with('success', 'Message saved!');
    }
}
