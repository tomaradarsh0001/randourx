<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Display users list
 public function index(Request $request)
{
    if ($request->ajax()) {
        $users = \App\Models\User::latest()->get();
        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('action', function($user){
            $edit = '<a href="'.route('users.edit', $user->id).'" class="btn btn-sm btn-primary me-1 mb-1">Edit</a>';
                $delete = '<form action="'.route('users.destroy', $user->id).'" method="POST" class="d-inline-block" onsubmit="return confirm(\'Are you sure?\')">'
                           .csrf_field().method_field('DELETE').
                           '<button type="submit" class="btn btn-sm btn-danger">Delete</button>
                           </form>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('admin.users.index');
}



    // Show form for creating new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show form for editing user
  // Show form for editing user
public function edit(User $user)
{
    return view('admin.users.edit', ['editUser' => $user]);
}


 public function update(Request $request, $id)
{
    Log::info("Update called for user ID: {$id}");

    $user = User::find($id);

    if (!$user) {
        Log::error("User with ID {$id} not found.");
        return redirect()->route('users.index')->with('error', 'User not found.');
    }

    Log::info("User found: ", $user->toArray());

    // Validate input
    $request->validate([
        'username'   => 'required|string|max:255|unique:users,username,' . $id,
        'full_name'  => 'required|string|max:255',
        'mobile'     => 'required|string|max:20|unique:users,mobile,' . $id,
        'email'      => 'required|email|max:255|unique:users,email,' . $id,
        'wallet1'    => 'required|numeric',
        'is_admin'   => 'nullable|boolean',
    ]);

    Log::info("Request data: ", $request->all());

    // Assign values explicitly
    $user->username  = $request->username;
    $user->full_name = $request->full_name;
    $user->mobile    = $request->mobile;
    $user->email     = $request->email;
    $user->wallet1   = $request->wallet1;
    $user->is_admin  = $request->boolean('is_admin');

    $saved = $user->save();

    if ($saved) {
        Log::info("User updated successfully: ", $user->toArray());
    } else {
        Log::error("User update failed for ID: {$id}");
    }

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}



    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
