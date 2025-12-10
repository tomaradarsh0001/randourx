<?php
// app/Services/FundTransferService.php

namespace App\Services;

use App\Models\FundTransfer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FundTransferService
{
    public function transferFunds($fromUserId, $toUserId, $amount, $walletType = 'wallet1', $description = null)
    {
        return DB::transaction(function () use ($fromUserId, $toUserId, $amount, $walletType, $description) {
            // Get users with lock for update to prevent race conditions
            $fromUser = User::where('id', $fromUserId)->lockForUpdate()->first();
            $toUser = User::where('id', $toUserId)->lockForUpdate()->first();

            if (!$fromUser || !$toUser) {
                throw new \Exception('User not found');
            }

            // Check if sender has sufficient balance
            if ($fromUser->{$walletType} < $amount) {
                throw new \Exception('Insufficient balance');
            }

            // Check if amount is positive
            if ($amount <= 0) {
                throw new \Exception('Amount must be greater than zero');
            }

            // Deduct from sender
            $fromUser->{$walletType} = $fromUser->{$walletType} - $amount;
            $fromUser->save();

            // Add to receiver
            $toUser->{$walletType} = $toUser->{$walletType} + $amount;
            $toUser->save();

            // Create transfer record
            $transfer = FundTransfer::create([
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'amount' => $amount,
                'wallet_type' => $walletType,
                'description' => $description,
                'status' => 'completed',
                'reference_id' => 'TRF-' . Str::random(10) . '-' . time(),
            ]);

            return $transfer;
        });
    }

    public function getTransferHistory($userId = null)
    {
        $query = FundTransfer::with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc');

        if ($userId) {
            $query->where(function($q) use ($userId) {
                $q->where('from_user_id', $userId)
                  ->orWhere('to_user_id', $userId);
            });
        }

        return $query->paginate(20);
    }
}