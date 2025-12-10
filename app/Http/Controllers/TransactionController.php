<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()
            ->where('type', 'deposit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('member.transactions.index', compact('transactions'));
    }

     public function withdraw()
    {
        $transactions = Auth::user()->transactions()
        ->where('type', 'withdrawal')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('member.transactions.withdrawal', compact('transactions'));
    }

    public function createDeposit()
    {
        return view('member.transactions.deposit');
    }

    public function storeDeposit(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
            'reference_id' => 'required|string|max:255',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle screenshot upload
        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('transaction-screenshots', 'public');
            $validated['screenshot'] = $path;
        }

        // Create transaction
        Auth::user()->transactions()->create([
            'type' => 'deposit',
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'reference_id' => $validated['reference_id'],
            'screenshot' => $validated['screenshot'],
            'status' => 'pending',
        ]);

        return redirect()->route('member.transactions.index')
            ->with('success', 'Deposit request submitted successfully. Waiting for admin approval.');
    }

    public function createWithdrawal()
    {
        return view('member.transactions.withdraw');
    }

    public function storeWithdrawal(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
            'account_details' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        // Check if user has sufficient balance in wallet2
        if ($user->wallet2 < $validated['amount']) {
            return back()->withErrors(['amount' => 'Insufficient balance in your wallet2.']);
        }

        DB::transaction(function () use ($validated, $user) {
            $user->transactions()->create([
                'type' => 'withdrawal',
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'reference_id' => $validated['account_details'],
                'status' => 'pending',
            ]);

            $user->decrement('wallet2', $validated['amount']);
            $user->increment('wallet4', $validated['amount']);
        });

        return redirect()->route('member.transactions.index')
            ->with('success', 'Withdrawal request submitted successfully. Waiting for admin approval.');
    }

    public function cancelWithdrawal($id)
    {
        $user = Auth::user();
        $transaction = $user->transactions()
            ->where('id', $id)
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->firstOrFail();

        DB::transaction(function () use ($transaction, $user) {
            // Update transaction status to cancelled
            $transaction->update([
                'status' => 'rejected',
                'cancelled_at' => now(),
            ]);

            // Revert the amount: subtract from wallet4 and add back to wallet2
            $user->decrement('wallet4', $transaction->amount);
            $user->increment('wallet2', $transaction->amount);
        });

        return redirect()->route('member.transactions.index')
            ->with('success', 'Withdrawal request cancelled successfully. Amount has been returned to your wallet.');
    }
}