<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProcessSalaryIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:process-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring salary income payments every 15 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting salary income processing...');
        $now = Carbon::now();

        // Get all users who have achieved at least one salary level with all required columns
        $eligibleUsers = DB::table('salary_records')
            ->join('users', 'salary_records.user_id', '=', 'users.id')
            ->where(function($query) {
                $query->where('achieved_30_days', true)
                      ->orWhere('achieved_60_days', true)
                      ->orWhere('achieved_90_days', true);
            })
            ->select(
                'salary_records.*', 
                'users.wallet3', 
                'users.income3',
                'users.id as user_id'
            )
            ->get();

        $processedCount = 0;

        foreach ($eligibleUsers as $userRecord) {
            $userId = $userRecord->user_id;
            
            // Determine the current active level (highest achieved)
            $currentLevel = null;
            $currentPercentage = 0;
            $lastPaymentColumn = null;
            $targetAmount = 0;

            if ($userRecord->achieved_90_days) {
                $currentLevel = '90_days';
                $currentPercentage = 16;
                $lastPaymentColumn = 'last_90_days_payment';
                $targetAmount = $userRecord->target_90_days;
            } elseif ($userRecord->achieved_60_days) {
                $currentLevel = '60_days';
                $currentPercentage = 10;
                $lastPaymentColumn = 'last_60_days_payment';
                $targetAmount = $userRecord->target_60_days;
            } elseif ($userRecord->achieved_30_days) {
                $currentLevel = '30_days';
                $currentPercentage = 4;
                $lastPaymentColumn = 'last_30_days_payment';
                $targetAmount = $userRecord->target_30_days;
            }

            if (!$currentLevel) {
                continue;
            }

            // Safely get the last payment date using null coalescing
            $lastPayment = null;
            if ($lastPaymentColumn === 'last_30_days_payment') {
                $lastPayment = $userRecord->last_30_days_payment ? Carbon::parse($userRecord->last_30_days_payment) : null;
            } elseif ($lastPaymentColumn === 'last_60_days_payment') {
                $lastPayment = $userRecord->last_60_days_payment ? Carbon::parse($userRecord->last_60_days_payment) : null;
            } elseif ($lastPaymentColumn === 'last_90_days_payment') {
                $lastPayment = $userRecord->last_90_days_payment ? Carbon::parse($userRecord->last_90_days_payment) : null;
            }

            // Check if 15 days have passed since last payment or if never paid
            $shouldProcessPayment = false;
            
            if (!$lastPayment) {
                // First payment - use the record's updated_at as achievement date
                $achievedDate = Carbon::parse($userRecord->updated_at);
                $shouldProcessPayment = $now->diffInDays($achievedDate) >= 15;
            } else {
                $shouldProcessPayment = $now->diffInDays($lastPayment) >= 15;
            }

            if ($shouldProcessPayment) {
                // Calculate the reward amount (percentage of target or wallet3, whichever is less)
                $targetReward = $targetAmount * ($currentPercentage / 100);
                $walletReward = $userRecord->wallet3 * ($currentPercentage / 100);
                $rewardAmount = min($targetReward, $walletReward);

                if ($rewardAmount > 0) {
                    // Start database transaction
                    DB::beginTransaction();

                    try {
                        // Credit to user's income3
                        DB::table('users')
                            ->where('id', $userId)
                            ->increment('income3', $rewardAmount);

                        // Record in salary_income table
                        DB::table('salary_income')->insert([
                            'user_id' => $userId,
                            'target_level' => $currentLevel,
                            'target_amount' => $targetAmount,
                            'user_wallet3_amount' => $userRecord->wallet3,
                            'calculated_percentage' => $currentPercentage,
                            'credited_amount' => $rewardAmount,
                            'description' => "Recurring {$currentLevel} salary income: {$currentPercentage}% of min(₹{$targetAmount}, ₹{$userRecord->wallet3}) = ₹{$rewardAmount}",
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);

                        // Update last payment date
                        DB::table('salary_records')
                            ->where('user_id', $userId)
                            ->update([$lastPaymentColumn => $now]);

                        DB::commit();
                        $processedCount++;

                        $this->info("Processed ₹{$rewardAmount} for user {$userId} ({$currentLevel})");

                    } catch (\Exception $e) {
                        DB::rollBack();
                        $this->error("Failed to process payment for user {$userId}: " . $e->getMessage());
                    }
                }
            }
        }

        $this->info("Salary income processing completed. Processed {$processedCount} users.");
        
        // Also log to Laravel log file
        \Log::info("Salary income processing completed. Processed {$processedCount} users.");
    }
}