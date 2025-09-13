<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoiIncome;
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
        $roiIncomes = RoiIncome::where('user_id', $user->id)
            ->orderBy('timing', 'desc')
            ->get();

        return view('member.wallets.income', compact('roiIncomes'));
    }
}
