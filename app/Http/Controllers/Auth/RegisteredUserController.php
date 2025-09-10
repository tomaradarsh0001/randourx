<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CountryCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class RegisteredUserController extends Controller
{
   
 public function create(): View
    {
        $countries = CountryCode::orderBy('country_name', 'ASC')->get();

        // Default country (India 🇮🇳)
        $default = [
            'code' => '+91',
            'name' => 'India',
            'flag' => 'https://flagcdn.com/w40/in.png',
        ];

        return view('auth.register', compact('countries', 'default'));
    }

    /**
     * Handle registration.
     */
   public function store(Request $request): RedirectResponse
{
    try {
        // Validate the request
        $request->validate([
            'sponsor_username' => ['nullable', 'exists:users,username'],
            'full_name'        => ['required', 'string', 'max:255'],
            'country_code'     => ['required', 'string', 'max:10'],
            'mobile'           => ['required', 'string', 'max:15', 'unique:users,mobile'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Log validation passed
        Log::info('Registration validation passed.', [
            'sponsor_username' => $request->sponsor_username,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        // Generate unique RX***** username
        do {
            $username = 'RX' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (User::where('username', $username)->exists());

        // Create user
        $user = User::create([
            'sponsor_username' => $request->sponsor_username,
            'username'         => $username,
            'full_name'        => $request->full_name,
            'country_code'     => $request->country_code,
            'mobile'           => $request->mobile,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
        ]);

        // Log user creation
        Log::info('New user registered successfully.', [
            'username' => $user->username,
            'email' => $user->email,
            'id' => $user->id,
        ]);

        // Fire the registered event
        event(new Registered($user));

        // Login the user
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    } catch (\Exception $e) {
        // Log any exception
        Log::error('Error during user registration.', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);

        return back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
    }
}

public function checkSponsor(Request $request)
{
    $request->validate([
        'username' => 'required|string|min:5'
    ]);

    $user = User::where('username', $request->username)->first();

    if($user){
        return response()->json([
            'exists' => true,
            'full_name' => $user->full_name
        ]);
    } else {
        return response()->json(['exists' => false]);
    }
}
public function checkUser(Request $request)
{
    $request->validate([
        'type' => 'required|in:mobile,email',
        'value' => 'required|string'
    ]);

    $exists = User::where($request->type, $request->value)->exists();

    return response()->json(['exists' => $exists]);
}
}
