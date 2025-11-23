<?php
// app/Http/Controllers/WalletAddressController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WalletAddressController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('my-account', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Check if wallet address already exists
        if ($user->wallet_address) {
            return redirect()->route('my-account')
                ->with('error', 'Wallet address cannot be modified once set.');
        }

        $validator = Validator::make($request->all(), [
            'wallet_address' => 'required|string|min:1|max:255',
        ], [
            'wallet_address.required' => 'Wallet address is required.',
            'wallet_address.min' => 'Wallet address must be at least 1 character.',
            'wallet_address.max' => 'Wallet address must not exceed 255 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('my-account')
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'wallet_address' => $request->wallet_address
        ]);

        return redirect()->route('my-account')
            ->with('success', 'Wallet address saved successfully!');
    }
}