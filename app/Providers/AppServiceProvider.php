<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\SalaryIncomeService;

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
    public function boot(SalaryIncomeService $salaryService): void
    {
        // Make authenticated user globally available as $user in all views
        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
        View::composer('*', function ($view) {
        $lastDeposit = null;

        if (Auth::check()) {
            $lastDeposit = DB::table('transactions')
                ->where('user_id', Auth::id())
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->value('amount');
        }

        $view->with('lastDeposit', $lastDeposit ?? 0);
      });
        view()->composer(['member.dashboard', 'member.downlines.index'], function ($view) use ($salaryService) {
            $user = Auth::user();

            $downlines = DB::table('downlines as d')
                ->join('users as u', 'd.descendant_id', '=', 'u.id')
                ->where('d.ancestor_id', $user->id)
                ->where('d.depth', '>', 0)
                ->select('u.id', 'u.wallet3', 'd.depth')
                ->get();
                
            $totalBusinessDownline = $downlines->sum('wallet3') + $user->wallet3;
            $totalBusiness = $totalBusinessDownline + $user->wallet3;
            $downlineCount = $downlines->count();
            $level1Count = $downlines->where('depth', 1)->count();

            // Get salary progress data for the dashboard
            $salaryProgress = $salaryService->getSalaryProgress($user);
            
            // Check eligibility for salary income
            $isEligibleForSalary = $salaryService->checkEligibilityFor($user) !== null;
            
            // Determine if modal should be shown (only when eligible)
            $showSalaryModal = $isEligibleForSalary;

            $view->with(compact(
                'totalBusinessDownline',
                'totalBusiness',
                'downlineCount',
                'level1Count',
                'user',
                'salaryProgress',
                'isEligibleForSalary',
                'showSalaryModal'
            ));
        });
    }
}