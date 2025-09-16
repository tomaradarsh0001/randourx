<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.transactions.index', compact('transactions'));
    }

    public function pending()
    {
        $transactions = Transaction::with('user')
            ->pending()
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.transactions.pending', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('user');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function approve(Request $request, Transaction $transaction)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction is not pending approval.');
        }

        \DB::transaction(function () use ($transaction, $request) {
            $user = $transaction->user;
            
            if ($transaction->type === 'deposit') {
                // Add amount to user's wallet1
                $user->wallet1 += $transaction->amount;
                $user->save();
            } elseif ($transaction->type === 'withdrawal') {
                // Check if user still has sufficient balance
                if ($user->wallet1 < $transaction->amount) {
                    return back()->with('error', 'User has insufficient balance for this withdrawal.');
                }
                
                // Deduct amount from user's wallet1
                $user->wallet1 -= $transaction->amount;
                $user->save();
            }

            // Update transaction status
            $transaction->update([
                'status' => 'approved',
                'admin_notes' => $request->admin_notes,
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);
        });

        return redirect()->route('admin.transactions.pending')
            ->with('success', 'Transaction approved successfully.');
    }

    public function reject(Request $request, Transaction $transaction)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction is not pending approval.');
        }

        $transaction->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('admin.transactions.pending')
            ->with('success', 'Transaction rejected successfully.');
    }
}