<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPurchase;


class MemberController extends Controller
{
    public function buyPackage(Request $request)
{
    $request->validate([
        'amount' => 'required|integer|min:10',
    ]);

    $user = Auth::user();
    $amount = $request->amount;

    // Ensure multiples of 10 and not exceeding balance
    if ($amount % 10 !== 0) {
        return back()->with('error', 'Amount must be in multiples of 10.');
    }

    if ($amount > $user->wallet1) {
        return back()->with('error', 'Amount exceeds available balance.');
    }

    // Deduct from wallet1 and add to wallet3
    $user->wallet1 -= $amount;
    $user->wallet3 += $amount;
    $user->save();

    // Record in user_purchases
    UserPurchase::create([
        'user_id'        => $user->id,
        'purchase_value' => $amount,
        'purchased_at'   => now(),
    ]);

    return back()->with('success', "Successfully invested $amount USD.");
}

}
