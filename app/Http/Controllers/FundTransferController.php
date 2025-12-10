<?php
// app/Http/Controllers/FundTransferController.php

namespace App\Http\Controllers;

use App\Services\FundTransferService;
use Illuminate\Http\Request;
use App\Models\User;

class FundTransferController extends Controller
{
    protected $fundTransferService;

    public function __construct(FundTransferService $fundTransferService)
    {
        $this->fundTransferService = $fundTransferService;
    }

    public function showTransferForm()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('member.fund-transfer.form', compact('users'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'wallet_type' => 'required|in:wallet1,wallet2',
            'description' => 'nullable|string|max:255'
        ]);

        try {
            $transfer = $this->fundTransferService->transferFunds(
                auth()->id(),
                $request->to_user_id,
                $request->amount,
                $request->wallet_type,
                $request->description
            );

            return redirect()->route('transfer.history')
                ->with('success', 'Funds transferred successfully! Reference: ' . $transfer->reference_id);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function history()
    {
        $transfers = $this->fundTransferService->getTransferHistory(auth()->id());
        return view('member.fund-transfer.history', compact('transfers'));
    }
public function validateUser(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|min:2'
            ]);

            $username = trim($request->username);

            $user = User::where(function($query) use ($username) {
                        $query->where('username', 'like', '%' . $username . '%')
                              ->orWhere('email', $username);
                    })
                    ->where('id', '!=', auth()->id())
                    ->first();

            if ($user) {
                return response()->json([
                    'success' => true,
                    'exists' => true,
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->name,
                        'email' => $user->email
                    ]
                ]);
            }

            return response()->json([
                'success' => true,
                'exists' => false,
                'message' => 'User not found'
            ]);

        } catch (\Exception $e) {
            Log::error('User validation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Validation error occurred'
            ], 500);
        }
    }

    // New method for user search with suggestions
    public function searchUsers(Request $request)
    {
        try {
            $request->validate([
                'query' => 'required|string|min:2'
            ]);

            $query = trim($request->query);

            $users = User::where(function($q) use ($query) {
                        $q->where('username', 'like', $query . '%')
                          ->orWhere('email', 'like', $query . '%');
                    })
                    ->where('id', '!=', auth()->id())
                    ->limit(5)
                    ->get(['id', 'username', 'email']);

            return response()->json([
                'success' => true,
                'users' => $users
            ]);

        } catch (\Exception $e) {
            Log::error('User search error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'users' => []
            ]);
        }
    }
    // Admin method to view all transfers
    public function adminHistory()
    {
        $transfers = $this->fundTransferService->getTransferHistory();
        return view('admin.fund-transfer.history', compact('transfers'));
    }
}