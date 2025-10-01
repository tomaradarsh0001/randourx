<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
  public function index()
    {
        try {
            $users = User::select('id', 'username', 'full_name', 'sponsor_username', 'mobile', 'email', 'wallet1', 'is_admin', 'created_at')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

            return view('admin.users.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading users.');
        }
    }

    /**
     * Login as another user (Impersonate)
     */
    public function loginAsUser($id)
    {
        try {
            // Get the original admin user
            $originalUserId = Auth::id();
            
            // Find the target user
            $targetUser = User::findOrFail($id);
            
            // Store original user ID in session for logout back
            session(['original_user_id' => $originalUserId]);
            session(['impersonating' => true]);
            
            // Log the impersonation
            Log::info("Admin {$originalUserId} is impersonating user {$targetUser->id} ({$targetUser->username})");
            
            // Login as the target user
            Auth::login($targetUser);
            
            return redirect('/dashboard')->with('success', 'You are now logged in as ' . $targetUser->username);

        } catch (\Exception $e) {
            Log::error('Error impersonating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error logging in as user.');
        }
    }

    
    public function logoutAsUser()
    {
        try {
            $currentUserId = Auth::id();
            $originalUserId = session('original_user_id');
            
            if ($originalUserId) {
                $originalUser = User::find($originalUserId);
                
                if ($originalUser) {
                    // Login back as original admin
                    Auth::login($originalUser);
                    
                    // Clear session data
                    session()->forget('original_user_id');
                    session()->forget('impersonating');
                    
                    Log::info("Admin {$originalUserId} stopped impersonating user {$currentUserId}");
                    
                    return redirect()->route('admin.users.index')->with('success', 'Welcome back, ' . $originalUser->username);
                }
            }
            
            // If something went wrong, just logout completely
            Auth::logout();
            return redirect('/login');

        } catch (\Exception $e) {
            Log::error('Error logging out from impersonation: ' . $e->getMessage());
            Auth::logout();
            return redirect('/login');
        }
    }
    
    public function generateImpersonationLink($id)
{
    $targetUser = User::findOrFail($id);

    // Generate secure random token
    $token = Str::random(40);

    // Store it in cache for 5 minutes
    Cache::put('impersonate_'.$token, $targetUser->id, now()->addMinutes(5));

    // Build URL
    $link = route('impersonate.login', ['id' => $targetUser->id, 'token' => $token]);

    // Show link in flash message (admin can copy & paste into incognito)
    return redirect()->back()->with('info', "Impersonation link generated. Open in new window/incognito: $link");
}

public function impersonateLogin($id, $token)
{
    $userId = Cache::pull('impersonate_'.$token);

    if ($userId && $userId == $id) {
        $user = User::findOrFail($id);
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'You are logged in as ' . $user->username);
    }

    return redirect('/login')->with('error', 'Invalid or expired impersonation link.');
}

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'full_name' => 'required|string|max:255',
                'mobile' => 'required|string|max:20|unique:users',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8|confirmed',
                'wallet1' => 'required|numeric|min:0',
                'is_admin' => 'nullable|boolean',
            ]);

            $user = User::create([
                'username' => $request->username,
                'full_name' => $request->full_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'wallet1' => (float) $request->wallet1,
                'is_admin' => $request->has('is_admin') ? 1 : 0,
                'country_code' => '+91',
            ]);

            Log::info("New user created: {$user->username} (ID: {$user->id})");
            return redirect()->route('admin.users.index')->with('success', 'User created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified user
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id)
    {
        try {
            $users = User::findOrFail($id);
            return view('admin.users.edit', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error fetching user for edit: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, $id)
    {
        Log::info("=== USER UPDATE STARTED ===");
        Log::info("Updating user ID: {$id}");

        try {
            $user = User::findOrFail($id);
            Log::info("Found user: {$user->username}");

            $validated = $request->validate([
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'full_name' => 'required|string|max:255',
                'mobile' => [
                    'required',
                    'string',
                    'max:20',
                    Rule::unique('users')->ignore($user->id)
                ],
                            'email' => 'required|email|max:255',

                'wallet1' => 'required|numeric|min:0',
                'is_admin' => 'nullable|boolean',
            ]);

            // Check for changes
            $changes = false;
            $updateData = [
                'username' => $request->username,
                'full_name' => $request->full_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'wallet1' => (float) $request->wallet1,
                'is_admin' => $request->has('is_admin') ? 1 : 0,
            ];

            foreach ($updateData as $field => $newValue) {
                $oldValue = $user->$field;
                if ((string)$oldValue !== (string)$newValue) {
                    $user->$field = $newValue;
                    $changes = true;
                    Log::info("Changed {$field}: '{$oldValue}' -> '{$newValue}'");
                }
            }

            if (!$changes) {
                Log::info("No changes detected for user ID: {$id}");
                return redirect()->route('admin.users.index')->with('info', 'No changes were made.');
            }

            $user->save();
            Log::info("✅ User updated successfully: {$user->username}");

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning("Validation failed for user update: " . json_encode($e->errors()));
            throw $e;
        } catch (\Exception $e) {
            Log::error("Error updating user: " . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $username = $user->username;
            $user->delete();

            Log::info("User deleted: {$username} (ID: {$id})");
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}