<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.otp-verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = Session::get('otp_email');
        $user = User::where('email', $email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        // Clear OTP after successful verification
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'otp_verified' => true,
        ]);

        // Log in the user manually
        Auth::login($user);

        // Debugging: Check if login was successful
        if (!Auth::check()) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }

        // Remove OTP session
        Session::forget('otp_email');

        return redirect()->route('dashboard')->with('message', 'Login successful');
    }
}
