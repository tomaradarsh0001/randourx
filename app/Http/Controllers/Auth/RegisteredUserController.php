<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

 
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sponsor_username' => ['nullable', 'exists:users,username'],
            'full_name'        => ['required', 'string', 'max:255'],
            'country_code'     => ['required', 'string', 'max:10'],
            'mobile'           => ['required', 'string', 'max:15', 'unique:users,mobile'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate unique RX***** username
            do {
                $username = 'RX' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            } while (User::where('username', $username)->exists());

        $user = User::create([
            'sponsor_username' => $request->sponsor_username,
            'username'         => $username,
            'full_name'        => $request->full_name,
            'country_code'     => $request->country_code,
            'mobile'           => $request->mobile,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}
