<?php
// app/Console/Commands/PaySalaryIncome.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SalaryIncome;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaySalaryIncome extends Command
{
    protected $signature = 'salary:pay';
    protected $description = 'Pay pending salary incomes which are older than 15 days';

    public function handle()
    {
        $this->info('Processing salary payments...');

        $cutoff = Carbon::now()->subSeconds(0);

        $pending = SalaryIncome::where('status', 'pending')
            ->where('eligible_at', '<=', $cutoff)
            ->get();

        foreach ($pending as $item) {
            DB::transaction(function() use ($item) {
                $user = $item->user()->lockForUpdate()->first();

                if (!$user) {
                    $this->warn("⚠️ User not found for salary id {$item->id}");
                    return; 
                }

                $currentWallet2 = (float)$user->wallet2;
                $currentWallet3 = (float)$user->wallet3;
                $maxWallet2 = $currentWallet3 * 2; // wallet2 can grow up to 2x wallet3
                $salaryAmount = (float)$item->amount;
                $potentialWallet2 = $currentWallet2 + $salaryAmount;

                // Check if there's any paid record for same user
                $paidRecordExists = SalaryIncome::where('user_id', $user->id)
                    ->where('status', 'paid')
                    ->exists();

                if ($paidRecordExists) {
                    // Auto-pay logic
                    if ($potentialWallet2 > $maxWallet2) {
                        $partialAmount = $maxWallet2 - $currentWallet2;

                        if ($partialAmount > 0) {
                            $user->income3 += $partialAmount;
                            $user->wallet2 += $partialAmount;
                            $user->save();

                            $item->status = 'partially_paid';
                            $item->paid_at = now();
                            $item->save();

                            $this->info("✅ Partially paid salary id {$item->id} for user {$user->id}, added {$partialAmount} out of {$salaryAmount} (wallet2 reached 2x wallet3 limit)");
                        } else {
                            $item->status = 'not_eligible';
                            $item->paid_at = now();
                            $item->save();
                            $this->warn("⏸ Salary id {$item->id} for user {$user->id} marked as not_eligible (wallet2 already at 2x wallet3 limit)");
                        }
                    } else {
                        $user->income3 += $salaryAmount;
                        $user->wallet2 += $salaryAmount;
                        $user->save();

                        $item->status = 'paid';
                        $item->paid_at = now();
                        $item->save();

                        $this->info("✅ Auto-paid salary id {$item->id} for user {$user->id}, amount={$salaryAmount}");
                    }
                    return;
                }

                $lastTransaction = Transaction::where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->latest('created_at')
                    ->first();

                if (!$lastTransaction) {
                    $this->warn("⏸ No approved transactions found for user {$user->id}, salary id {$item->id}");
                    return; 
                }

                $newDownlines = DB::table('downlines as d')
                    ->join('users as u', 'd.descendant_id', '=', 'u.id')
                    ->where('d.ancestor_id', $user->id)
                    ->where('d.depth', 1) 
                    ->where('u.created_at', '>', $item->created_at)
                    ->select('u.id', 'u.wallet3')
                    ->get();

                $newDownlinesCount = $newDownlines->count();

                $walletCheck = $newDownlines->contains(function ($downline) use ($lastTransaction) {
                    return $downline->wallet3 >= $lastTransaction->amount;
                });

                $this->info("User {$user->id}: New downlines after salary = {$newDownlinesCount}, Last transaction = {$lastTransaction->amount}");
                $this->info("New downlines wallet3 balances: " . $newDownlines->pluck('wallet3')->implode(', '));
                $this->info("Wallet check = " . ($walletCheck ? 'PASS' : 'FAIL'));

                if ($newDownlinesCount > 0 && $walletCheck) {
                    if ($potentialWallet2 > $maxWallet2) {
                        $partialAmount = $maxWallet2 - $currentWallet2;

                        if ($partialAmount > 0) {
                            $user->income3 += $partialAmount;
                            $user->wallet2 += $partialAmount;
                            $user->save();

                            $item->status = 'partially_paid';
                            $item->paid_at = now();
                            $item->save();

                            $this->info("✅ Partially paid salary id {$item->id} for user {$user->id}, added {$partialAmount} out of {$salaryAmount} (wallet2 reached 2x wallet3 limit)");
                        } else {
                            $item->status = 'not_eligible';
                            $item->paid_at = now();
                            $item->save();
                            $this->warn("⏸ Salary id {$item->id} for user {$user->id} marked as not_eligible (wallet2 already at 2x wallet3 limit)");
                        }
                    } else {
                        $user->income3 += $salaryAmount;
                        $user->wallet2 += $salaryAmount;
                        $user->save();

                        $item->status = 'paid';
                        $item->paid_at = now();
                        $item->save();

                        $this->info("✅ Paid salary id {$item->id} for user {$user->id}, amount={$salaryAmount}");
                    }
                } else {
                    $reason = !$walletCheck ? "no new downlines with sufficient wallet3" : "no new downlines";
                    $this->warn("⏸ Skipped salary id {$item->id} for user {$user->id} ({$reason})");
                }
            });
        }

        $this->info('Salary payment processing completed.');
    }
}
