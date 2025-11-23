<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string'
        ]);

        Log::info('Forgot password request started', ['username' => $request->username]);

        // Find user by username only
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            Log::warning('User not found for password reset', ['username' => $request->username]);
            return back()->withErrors(['username' => 'User not found!']);
        }

        // Clean the email address (remove any newlines or spaces)
        $user->email = trim($user->email);
        
        Log::info('User found', [
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ]);

        // Generate random password
        $newPassword = Str::random(10);

        // Update hashed password in DB
        $user->password = Hash::make($newPassword);
        $user->save();

        Log::info('Password updated in database', ['user_id' => $user->id]);

        try {
            // Log email sending attempt
            Log::info('Attempting to send email', [
                'to' => $user->email,
                'mailer' => config('mail.default'),
                'from' => config('mail.from.address')
            ]);

            // Send email to registered email
            Mail::send(new ForgotPasswordMail($user, $newPassword));

            Log::info('Email sent successfully', ['to' => $user->email]);

        } catch (\Exception $e) {
            Log::error('Email sending failed', [
                'to' => $user->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['email' => 'Failed to send email. Please try again later.']);
        }

        return back()->with('success', 'A new password has been sent to the registered email of this username.');
    }
      public function showForgotForm()
    {
        return view('member.forgot');
    }
    public function forgot(Request $request)
{
    $request->validate([
        'username' => 'required'
    ]);

    // Logged-in user's ID
    $loggedUserId = auth()->user()->username;

    // Check match
    if ($request->username !== $loggedUserId) {
        return back()->withErrors('User ID does not match your account.');
    }

    // Continue password reset process...
    return back()->with('success', 'Password reset instructions sent to your email.');
}
public function changePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:8',
        'confirm_password' => 'required|same:new_password',
    ]);

    $user = Auth::user();

    // Check if old password matches
    if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'Current password is incorrect.']);
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password changed successfully.');
}
}