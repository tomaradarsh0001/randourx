<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // Show admin login form
    public function showLoginForm()
    {
        return view('auth.admin_login'); // We'll create this view
    }

    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user with is_admin = 1
        $user = User::where('email', $request->email)
                    ->where('is_admin', 1)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Invalid admin credentials',
            ]);
        }

        // Log in the admin
        Auth::login($user);

        // Redirect to admin dashboard
        return redirect()->route('admindashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
