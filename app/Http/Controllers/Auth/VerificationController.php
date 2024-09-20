<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\OtpMail;
use App\Models\User;

class VerificationController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = Str::random(6); // Generate a 6-character OTP
        $expiresAt = now()->addMinutes(10); // OTP valid for 10 minutes

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => $expiresAt,
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'OTP sent successfully.']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->otp === $request->otp && now()->lessThanOrEqualTo($user->otp_expires_at)) {
            // OTP is valid
            $user->update([
                'otp' => null,
                'otp_expires_at' => null,
            ]);

            // Proceed with registration or other logic
            return response()->json(['message' => 'OTP verified successfully.']);
        }

        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }
}
