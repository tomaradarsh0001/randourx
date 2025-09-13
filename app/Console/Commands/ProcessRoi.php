<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\RoiRate;
use App\Models\RoiIncome;

class ProcessRoi extends Command
{
    protected $signature = 'roi:process';
    protected $description = 'Process daily ROI and add to wallet2 & income1';

    public function handle()
    {
        $roiRate = RoiRate::latest()->first();
        if (!$roiRate) {
            $this->info('No ROI rate found.');
            return 0;
        }

        $rate = $roiRate->rate;

        $users = User::all();

        foreach ($users as $user) {
            if ($user->wallet3 > 0) {
                $roiAmount = ($user->wallet3 * $rate) / 100;

                // Update wallets
                $user->wallet2 += $roiAmount;
                $user->income1 += $roiAmount; // ✅ update income1
                $user->save();

                // Log in roi_incomes table
                RoiIncome::create([
                    'user_id'      => $user->id,
                    'from_admin'   => 1,
                    'wallet_value' => $user->wallet3,
                    'roi_bonus'    => $roiAmount,
                ]);
            }
        }

        $this->info('ROI processed successfully for all users.');
        return 0;
    }
}
