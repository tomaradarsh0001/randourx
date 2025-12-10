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
use Illuminate\Support\Facades\DB;
use App\Mail\RegistrationSuccessMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;


class RegisteredUserController extends Controller
{
   
public function create(): View
{
    $countries = CountryCode::orderBy('country_name', 'ASC')->get();

    $default = [
        'code' => 'Select Code',
        'name' => '',
        'flag' => asset('assets/img/code.png'), // ✅ Proper asset path
    ];

    return view('auth.register', compact('countries', 'default'));
}


 public function store(Request $request): RedirectResponse
{
    try {
        // âœ… Step 1: Validation
        $request->validate([
            'sponsor_username' => ['nullable', 'exists:users,username'],
            'full_name'        => ['required', 'string', 'max:255'],
            'country_code'     => ['required', 'string', 'max:10'],
            'mobile'           => ['required', 'string', 'max:15', 'regex:/^[0-9]{6,15}$/'],
            'email'            => ['required', 'string', 'email', 'max:255'],
            'password'         => ['required', 'confirmed', Password::min(4)],
        ]);

        // âœ… Step 2: Get Sponsor
        $sponsor = null;
        if ($request->sponsor_username) {
            $sponsor = User::where('username', $request->sponsor_username)->first();
        }

        // âœ… Step 3: Generate unique username
        do {
            $username = 'RX' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (User::where('username', $username)->exists());

        // âœ… Step 4: Create User
        $user = User::create([
            'sponsor_id'       => $sponsor?->id,
            'sponsor_username' => $request->sponsor_username,
            'username'         => $username,
            'full_name'        => $request->full_name,
            'country_code'     => $request->country_code,
            'mobile'           => $request->mobile,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
                            'plain_password'   => $request->password, // ⚠️ Store plain password

        ]);

        // âœ… Step 5: Build Downline Tracking
        DB::transaction(function () use ($user, $sponsor) {
            // Add self-reference (depth 0)
            DB::table('downlines')->insert([
                'ancestor_id'   => $user->id,
                'descendant_id' => $user->id,
                'depth'         => 0,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            if ($sponsor) {
                // Inherit all sponsor's ancestors
                $ancestors = DB::table('downlines')
                    ->where('descendant_id', $sponsor->id)
                    ->get();

                foreach ($ancestors as $ancestor) {
                    DB::table('downlines')->insert([
                        'ancestor_id'   => $ancestor->ancestor_id,
                        'descendant_id' => $user->id,
                        'depth'         => $ancestor->depth + 1,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
        });

        // âœ… Step 6: Send Registration Email (Safe)
        try {
            Mail::to($user->email)->send(new RegistrationSuccessMail($user, $request->password));
        } catch (\Exception $mailException) {
            Log::error('Mail sending failed.', [
                'error' => $mailException->getMessage(),
            ]);
        }

        // âœ… Step 7: Store registration data in session for popup display
        $registrationData = [
            'success' => true,
            'message' => 'You are successfully registered in our portal!',
            'user_data' => [
                'full_name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'password' => $request->password, // Display plain password for user reference
                'mobile' => $user->country_code . $user->mobile,
                'sponsor' => $user->sponsor_username ?? 'None',
                'registration_date' => now()->format('F j, Y \a\t g:i A'),
            ]
        ];

        // âœ… Step 8: Redirect back to registration page with success data
        return redirect()->route('register') // Change 'register' to your actual registration route name
            ->with('registration_success', $registrationData);

    } catch (\Exception $e) {
        Log::error('Error during user registration.', [
            'error'   => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);

        return back()->withInput()->withErrors([
            'error' => 'Registration failed. Please try again.'
        ]);
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
