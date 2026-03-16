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

    try {

        \DB::transaction(function () use ($transaction, $request) {

            $user = $transaction->user;

            if ($transaction->type === 'deposit') {

                // Add full amount to wallet1
                $user->wallet1 += $transaction->amount;
                $user->save();

            } elseif ($transaction->type === 'withdrawal') {

                $originalAmount = $transaction->amount;
                $deduction = $originalAmount * 0.10;      // 10% fee
                $finalAmount = $originalAmount - $deduction; // 90% deduction

                // ✅ Check if wallet2 has enough balance
                if ($user->wallet2 < $finalAmount) {
                    throw new \Exception('Insufficient balance in Wallet2.');
                }

                // Deduct 90% from wallet2
                // $user->wallet2 -= $finalAmount;
                $user->save();
            }

            // Update transaction
            $transaction->update([
                'status' => 'approved',
                'admin_notes' => $request->admin_notes,
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);
        });

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }

    return redirect()
        ->route('admin.transactions.pending')
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

    try {

        \DB::transaction(function () use ($transaction, $request) {

            $user = $transaction->user;

            // If withdrawal, refund the deducted amount
            if ($transaction->type === 'withdrawal') {

                // Refund full original amount
                $user->wallet2 += $transaction->amount;
                $user->wallet4 -= $transaction->amount;
                $user->save();
            }

            // If deposit and you previously held balance somewhere,
            // you could revert here (currently nothing needed)

            $transaction->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);
        });

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }

    return redirect()
        ->route('admin.transactions.pending')
        ->with('success', 'Transaction rejected and amount refunded successfully.');
}
}