<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoiIncome;
use App\Models\User;
use App\Models\LevelIncome;
use App\Models\Transaction;
use App\Models\UserPurchase;
use Illuminate\Support\Facades\Auth; 


class UserDashboardController extends Controller
{

    public function roiHistory()
    {
        $user = Auth::user();
        $roiIncomes = RoiIncome::where('user_id', $user->id)
            ->orderBy('timing', 'desc')
            ->get();

        return view('member.roi.view', compact('roiIncomes'));
    }

    public function investments()
    {
        $user = Auth::user();

        $investments = UserPurchase::where('user_id', $user->id)
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('member.wallets.invest', compact('investments'));
    }

     public function wallet2Incomes()
   {
    $user = Auth::user();
    
    // Get ROI incomes
    $roiIncomes = RoiIncome::where('user_id', $user->id)
        ->orderBy('timing', 'desc')
        ->get()
        ->map(function ($income) {
            $income->type = 'ROI Income';
            $income->source = 'Daily Process';
            $income->amount = $income->roi_bonus;
            $income->investment = $income->wallet_value;
            return $income;
        });
        // dd( $roiIncomes );
    // Get level incomes (assuming you have a LevelIncome model)
    $levelIncomes = LevelIncome::where('to_user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($income) {
            $income->type = 'Level Income';
            $income->source = 'Level ' . $income->level . ' Commission';
            $income->amount = $income->amount;
            
            // Calculate pack value based on percentage and amount
            // If percentage is 10% and amount is $10, then pack value = $100
            if ($income->percentage > 0) {
                $income->investment = ($income->amount / $income->percentage) * 100;
            } else {
                $income->investment = 0;
            }
            
            $income->timing = $income->created_at;
            $income->percentage_display = $income->percentage . '%';
            
            // Add details about the referrer
            $referrer = User::find($income->from_user_id);
            if ($referrer) {
                $income->details = 'From: ' . $referrer->username . ' (' . $referrer->name . ')';
            } else {
                $income->details = 'From: Unknown user';
            }
            
            return $income;
        });
    
    $allIncomes = $roiIncomes
    ->concat($levelIncomes)   
    ->sortByDesc('timing')
    ->values();              

    return view('member.wallets.income', compact('allIncomes'));
}
    public function depositHistory()
{
    $user = Auth::user();
    
    $deposits = Transaction::where('user_id', $user->id)
        ->where('type', 'deposit')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Use paginate instead of get
    
    return view('member.wallets.deposit', compact('deposits'));
}
}
