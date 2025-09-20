<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Make authenticated user globally available as $user in all views
        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
        
        view()->composer(['member.dashboard', 'member.downlines.index', 'member.salary.*'], function ($view) {
            $user = Auth::user();
            
            if (!$user) {
                return;
            }

            $downlines = DB::table('downlines as d')
                ->join('users as u', 'd.descendant_id', '=', 'u.id')
                ->where('d.ancestor_id', $user->id)
                ->where('d.depth', '>', 0)
                ->select('u.id', 'u.wallet3', 'd.depth', 'u.created_at')
                ->get();
                
            $totalBusinessDownline = $downlines->sum('wallet3');
            $totalBusiness = $totalBusinessDownline + $user->wallet3;
            $downlineCount = $downlines->count();
            $level1Count = $downlines->where('depth', 1)->count();

            // Salary income calculations
            $userCreatedAt = Carbon::parse($user->created_at);
            $now = Carbon::now();
            
            // Check if user has a salary record, create if not
            $salaryRecord = DB::table('salary_records')->where('user_id', $user->id)->first();
            
            if (!$salaryRecord) {
                $thirtyDaysDeadline = $userCreatedAt->copy()->addDays(30);
                $sixtyDaysDeadline = $userCreatedAt->copy()->addDays(60);
                $ninetyDaysDeadline = $userCreatedAt->copy()->addDays(90);
                
                DB::table('salary_records')->insert([
                    'user_id' => $user->id,
                    'target_30_days' => 2500,
                    'target_60_days' => 5000,
                    'target_90_days' => 10000,
                    'achieved_30_days' => false,
                    'achieved_60_days' => false,
                    'achieved_90_days' => false,
                    'deadline_30_days' => $thirtyDaysDeadline,
                    'deadline_60_days' => $sixtyDaysDeadline,
                    'deadline_90_days' => $ninetyDaysDeadline,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $salaryRecord = DB::table('salary_records')->where('user_id', $user->id)->first();
            }
            
            // Check achievements
            $achieved30Days = $salaryRecord->achieved_30_days;
            $achieved60Days = $salaryRecord->achieved_60_days;
            $achieved90Days = $salaryRecord->achieved_90_days;
            
            $thirtyDaysDeadline = Carbon::parse($salaryRecord->deadline_30_days);
            $sixtyDaysDeadline = Carbon::parse($salaryRecord->deadline_60_days);
            $ninetyDaysDeadline = Carbon::parse($salaryRecord->deadline_90_days);
            
            // Calculate days left (but don't show negative days)
            $daysTo30Target = max(0, $now->diffInDays($thirtyDaysDeadline, false));
            $daysTo60Target = max(0, $now->diffInDays($sixtyDaysDeadline, false));
            $daysTo90Target = max(0, $now->diffInDays($ninetyDaysDeadline, false));
            
            // Check expiration status
            $expired30Days = $now->gt($thirtyDaysDeadline) && !$achieved30Days;
            $expired60Days = $now->gt($sixtyDaysDeadline) && !$achieved60Days;
            $expired90Days = $now->gt($ninetyDaysDeadline) && !$achieved90Days;
            
            // Check if targets are achieved but not recorded and credit salary
            if (!$achieved30Days && $totalBusinessDownline >= 2500 && $now->lte($thirtyDaysDeadline)) {
                DB::table('salary_records')
                    ->where('user_id', $user->id)
                    ->update(['achieved_30_days' => true]);
                $achieved30Days = true;
                
                // Calculate 4% of 2500 or user's wallet3 (whichever is less)
                $targetAmount = 2500;
                $percentage = 4;
                $targetReward = $targetAmount * ($percentage / 100);
                $walletReward = $user->wallet3 * ($percentage / 100);
                $rewardAmount = min($targetReward, $walletReward);
                
                // Credit to user's income3
                DB::table('users')
                    ->where('id', $user->id)
                    ->increment('income3', $rewardAmount);
                
                // Record in salary_income table
                DB::table('salary_income')->insert([
                    'user_id' => $user->id,
                    'target_level' => '30_days',
                    'target_amount' => $targetAmount,
                    'user_wallet3_amount' => $user->wallet3,
                    'calculated_percentage' => $percentage,
                    'credited_amount' => $rewardAmount,
                    'description' => "30 days salary income: 4% of min(${$targetAmount}, ${$user->wallet3}) = ${$rewardAmount}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            if (!$achieved60Days && $totalBusinessDownline >= 5000 && $now->lte($sixtyDaysDeadline)) {
                DB::table('salary_records')
                    ->where('user_id', $user->id)
                    ->update(['achieved_60_days' => true]);
                $achieved60Days = true;
                
                // Calculate 10% of 5000 or user's wallet3 (whichever is less)
                $targetAmount = 5000;
                $percentage = 10;
                $targetReward = $targetAmount * ($percentage / 100);
                $walletReward = $user->wallet3 * ($percentage / 100);
                $rewardAmount = min($targetReward, $walletReward);
                
                // Credit to user's income3
                DB::table('users')
                    ->where('id', $user->id)
                    ->increment('income3', $rewardAmount);
                
                // Record in salary_income table
                DB::table('salary_income')->insert([
                    'user_id' => $user->id,
                    'target_level' => '60_days',
                    'target_amount' => $targetAmount,
                    'user_wallet3_amount' => $user->wallet3,
                    'calculated_percentage' => $percentage,
                    'credited_amount' => $rewardAmount,
                    'description' => "60 days salary income: 10% of min(${$targetAmount}, ${$user->wallet3}) = ${$rewardAmount}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            if (!$achieved90Days && $totalBusinessDownline >= 10000 && $now->lte($ninetyDaysDeadline)) {
                DB::table('salary_records')
                    ->where('user_id', $user->id)
                    ->update(['achieved_90_days' => true]);
                $achieved90Days = true;
                
                // Calculate 16% of 10000 or user's wallet3 (whichever is less)
                $targetAmount = 10000;
                $percentage = 16;
                $targetReward = $targetAmount * ($percentage / 100);
                $walletReward = $user->wallet3 * ($percentage / 100);
                $rewardAmount = min($targetReward, $walletReward);
                
                // Credit to user's income3
                DB::table('users')
                    ->where('id', $user->id)
                    ->increment('income3', $rewardAmount);
                
                // Record in salary_income table
                DB::table('salary_income')->insert([
                    'user_id' => $user->id,
                    'target_level' => '90_days',
                    'target_amount' => $targetAmount,
                    'user_wallet3_amount' => $user->wallet3,
                    'calculated_percentage' => $percentage,
                    'credited_amount' => $rewardAmount,
                    'description' => "90 days salary income: 16% of min(${$targetAmount}, ${$user->wallet3}) = ${$rewardAmount}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            // Calculate progress percentages
            $progress30 = min(100, ($totalBusinessDownline / 2500) * 100);
            $progress60 = min(100, ($totalBusinessDownline / 5000) * 100);
            $progress90 = min(100, ($totalBusinessDownline / 10000) * 100);
            
            // Check if user needs to add more direct referrals
            $needsMoreReferrals = false;
            $referralMessage = null;
            
            if ($totalBusinessDownline >= 2500 && !$achieved30Days && $now->lte($thirtyDaysDeadline)) {
                $needsMoreReferrals = true;
                $referralMessage = "Congratulations! You've reached $2500 in downline business. To qualify for your salary income, you need to add one more direct referral with an investment equal to or greater than your last investment.";
            }

            $view->with(compact(
                'totalBusinessDownline',
                'totalBusiness',
                'downlineCount',
                'level1Count',
                'user',
                'progress30',
                'progress60',
                'progress90',
                'achieved30Days',
                'achieved60Days',
                'achieved90Days',
                'daysTo30Target',
                'daysTo60Target',
                'daysTo90Target',
                'expired30Days',
                'expired60Days',
                'expired90Days',
                'needsMoreReferrals',
                'referralMessage'
            ));
        });
    }
}