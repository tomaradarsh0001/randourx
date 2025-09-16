<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('member.transactions.index', compact('transactions'));
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

        // Check if user has sufficient balance
        if (Auth::user()->wallet1 < $validated['amount']) {
            return back()->withErrors(['amount' => 'Insufficient balance in your wallet.']);
        }

        // Create withdrawal request
        Auth::user()->transactions()->create([
            'type' => 'withdrawal',
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'reference_id' => $validated['account_details'],
            'status' => 'pending',
        ]);

        return redirect()->route('member.transactions.index')
            ->with('success', 'Withdrawal request submitted successfully. Waiting for admin approval.');
    }
}