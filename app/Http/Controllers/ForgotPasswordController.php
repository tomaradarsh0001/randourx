<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string'
        ]);

        // Find user by username only
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'User not found!']);
        }

        // Generate random password
        $newPassword = Str::random(10);

        // Update hashed password in DB
        $user->password = Hash::make($newPassword);
        $user->save();

        // Send email to registered email
        Mail::to($user->email)->send(new ForgotPasswordMail($user, $newPassword));

        return back()->with('success', 'A new password has been sent to the registered email of this username.');
    }
}
