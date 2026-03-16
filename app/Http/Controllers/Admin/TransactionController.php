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
    // Log initial request data
    \Log::info('Transaction approval started', [
        'transaction_id' => $transaction->id,
        'user_id' => $transaction->user_id,
        'transaction_type' => $transaction->type,
        'transaction_amount' => $transaction->amount,
        'current_status' => $transaction->status,
        'admin_id' => auth()->id(),
        'request_data' => $request->all()
    ]);
    
    $request->validate([
        'admin_notes' => 'nullable|string|max:1000',
    ]);
    
    \Log::info('Validation passed for transaction', ['transaction_id' => $transaction->id]);
    
    if ($transaction->status !== 'pending') {
        \Log::warning('Transaction not pending', [
            'transaction_id' => $transaction->id,
            'current_status' => $transaction->status,
            'expected_status' => 'pending'
        ]);
        return back()->with('error', 'Transaction is not pending approval.');
    }
    
    \Log::info('Transaction status verified as pending', ['transaction_id' => $transaction->id]);

    try {
        \DB::transaction(function () use ($transaction, $request) {
            \Log::info('Database transaction started', ['transaction_id' => $transaction->id]);
            
            $user = $transaction->user;
            
            \Log::info('User retrieved', [
                'transaction_id' => $transaction->id,
                'user_id' => $user->id,
                'wallet1_balance' => $user->wallet1,
                'wallet2_balance' => $user->wallet2,
                'user_email' => $user->email
            ]);

            if ($transaction->type === 'deposit') {
                \Log::info('Processing deposit transaction - APPROVING WITHOUT WALLET UPDATE', [
                    'transaction_id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'wallet1_before' => $user->wallet1,
                    'wallet1_after' => $user->wallet1 // No change
                ]);

                // ❌ NO WALLET UPDATE FOR DEPOSIT - Just approve
                // $user->wallet1 += $transaction->amount;
                // $user->save();

            } elseif ($transaction->type === 'withdrawal') {
                \Log::info('Processing withdrawal transaction - APPROVING WITHOUT WALLET CHECK OR DEDUCTION', [
                    'transaction_id' => $transaction->id,
                    'original_amount' => $transaction->amount,
                    'wallet2_before' => $user->wallet2,
                    'wallet2_after' => $user->wallet2 // No change
                ]);

                // ❌ NO WALLET CHECK OR DEDUCTION FOR WITHDRAWAL - Just approve
                // No wallet2 balance check
                // No wallet2 deduction
                // $user->wallet2 is not modified

            } else {
                \Log::error('Invalid transaction type', [
                    'transaction_id' => $transaction->id,
                    'type' => $transaction->type
                ]);
                throw new \Exception('Invalid transaction type: ' . $transaction->type);
            }

            // Update transaction - THIS IS THE ONLY THING THAT HAPPENS
            \Log::info('Updating transaction record to approved', [
                'transaction_id' => $transaction->id,
                'old_status' => $transaction->status,
                'new_status' => 'approved'
            ]);
            
            $transaction->update([
                'status' => 'approved',
                'admin_notes' => $request->admin_notes,
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);
            
            \Log::info('Transaction approved successfully without wallet modifications', [
                'transaction_id' => $transaction->id,
                'approved_at' => now(),
                'approved_by' => auth()->id(),
                'wallet1_unchanged' => $user->wallet1,
                'wallet2_unchanged' => $user->wallet2
            ]);
        });
        
        \Log::info('Database transaction completed successfully - Transaction approved', ['transaction_id' => $transaction->id]);

    } catch (\Exception $e) {
        \Log::error('Transaction approval failed', [
            'transaction_id' => $transaction->id,
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'error_trace' => $e->getTraceAsString()
        ]);
        return back()->with('error', 'Error: ' . $e->getMessage());
    }

    \Log::info('Transaction approval completed, redirecting', [
        'transaction_id' => $transaction->id,
        'redirect_to' => 'admin.transactions.pending'
    ]);

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