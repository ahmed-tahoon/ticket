<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function __construct() {
        
    }

    function create() {
        return view('auth.otp');
    }


    public function store(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not logged in.');
        }

        if ($user->otp !== $request->otp) {
            return back()->with('error', 'Invalid OTP.');
        }

        // Check if the OTP has expired (more than 30 minutes old)
        if ($user->otp_expiry < now()->subMinutes(30)) {
            return back()->with('error', 'OTP has expired.');
        }

        // Update pass_otp to true
        $user->pass_otp = true;
        $user->save();

        return redirect()->intended('/')->with('success', 'OTP verification successful.');
    }
}
