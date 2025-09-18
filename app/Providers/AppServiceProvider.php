<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        view()->composer(['member.dashboard', 'member.downlines.index'], function ($view) {
            $user = Auth::user();

            $downlines = DB::table('downlines as d')
                ->join('users as u', 'd.descendant_id', '=', 'u.id')
                ->where('d.ancestor_id', $user->id)
                ->where('d.depth', '>', 0)
                ->select('u.id', 'u.wallet3', 'd.depth')
                ->get();
            $totalBusinessDownline = $downlines->sum('wallet3') + $user->wallet3;
            // $totalBusinessDownline = $downlines->sum('wallet3');
            $totalBusiness = $totalBusinessDownline + $user->wallet3;
            $downlineCount = $downlines->count();
            $level1Count = $downlines->where('depth', 1)->count();

            $view->with(compact(
                'totalBusinessDownline',
                'totalBusiness',
                'downlineCount',
                'level1Count',
                'user'  
            ));
        });
    }
}
