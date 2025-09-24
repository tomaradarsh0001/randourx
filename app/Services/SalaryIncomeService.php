<?php
namespace App\Services;

use App\Models\SalaryIncome;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryIncomeService
{
    /**
     * Compute totalBusinessDownline for a user (sum of wallet3 of downlines + user.wallet3)
     */
    public function computeTotalBusinessDownline(User $user): float
    {
        $downlines = DB::table('downlines as d')
            ->join('users as u', 'd.descendant_id', '=', 'u.id')
            ->where('d.ancestor_id', $user->id)
            ->where('d.depth', '>', 0)
            ->select('u.wallet3')
            ->get();

        $sumDownline = (float) $downlines->sum('wallet3');
        return $sumDownline + (float) $user->wallet3;
    }

    /**
     * Returns thresholds for first 30 days and next windows
     */
    public function getThresholds(User $user)
    {
        $days = $user->created_at->diffInDays(now());

        if ($days <= 30) {
            return [
                ['amount' => 10000, 'percentage' => 16, 'level' => 3],
                ['amount' => 5000,  'percentage' => 10, 'level' => 2],
                ['amount' => 2500,  'percentage' => 4,  'level' => 1],
            ];
        } elseif ($days <= 60) {
            return [
                ['amount' => 7500, 'percentage' => 10, 'level' => 2],
            ];
        } elseif ($days <= 90) {
            return [
                ['amount' => 17500, 'percentage' => 16, 'level' => 3],
            ];
        }

        return []; 
    }

    public function checkEligibilityFor(User $user)
    {
        $now = now();
        $totalBusiness = $this->computeTotalBusinessDownline($user);
        $wallet3 = (float) $user->wallet3;

        foreach ($this->getThresholds($user) as $threshold) {
            if ($totalBusiness >= $threshold['amount']) {
                $useAmount = min($threshold['amount'], $wallet3);
                $payout = round(($useAmount * $threshold['percentage']) / 100, 2);

                return [
                    'user_id' => $user->id,
                    'amount' => $payout,
                    'percentage' => $threshold['percentage'],
                    'threshold' => $threshold['amount'],
                    'level' => $threshold['level'],
                    'eligible_at' => $now,
                    'note' => "Reached {$threshold['amount']} level. TotalBusinessDownline={$totalBusiness}",
                ];
            }
        }

        return null;
    }

    public function getSalaryProgress(User $user)
    {
        $days = $user->created_at->diffInDays(now());
        $totalBusiness = $this->computeTotalBusinessDownline($user);

        $firstWindow = [
            ['amount' => 2500, 'percentage' => 4, 'level' => 1],
            ['amount' => 5000, 'percentage' => 10, 'level' => 2],
            ['amount' => 10000, 'percentage' => 16, 'level' => 3],
        ];

        $progress = [];

        $firstWindowAchieved = collect($firstWindow)->every(function($level) use($totalBusiness){
            return $totalBusiness >= $level['amount'];
        });

        foreach ($firstWindow as $level) {
            $status = ($totalBusiness >= $level['amount']) ? 'achieved' : 'pending';
            if ($days > 30 && $status != 'achieved') $status = 'expired';

            $percent = min(100, round(($totalBusiness / $level['amount']) * 100, 2));

            $progress[] = [
                'level' => $level['level'],
                'amount' => $level['amount'],
                'percentage' => $level['percentage'],
                'status' => $status,
                'percent' => $percent,
                'target' => $level['amount'],
            ];
        }

        // Next window thresholds appear only if first window not fully achieved
        if (!$firstWindowAchieved && $days > 30 && $days <= 60) {
            $status = ($totalBusiness >= 7500) ? 'achieved' : 'pending';
            $progress[] = [
                'level' => 2,
                'amount' => 7500,
                'percentage' => 10,
                'status' => $status,
                'percent' => min(100, round(($totalBusiness / 7500) * 100, 2)),
                'target' => 7500,
            ];
        }

        if (!$firstWindowAchieved && $days > 60 && $days <= 90) {
            $status = ($totalBusiness >= 17500) ? 'achieved' : 'pending';
            $progress[] = [
                'level' => 3,
                'amount' => 17500,
                'percentage' => 16,
                'status' => $status,
                'percent' => min(100, round(($totalBusiness / 17500) * 100, 2)),
                'target' => 17500,
            ];
        }

        // Sort by level to maintain order
        usort($progress, function($a, $b) {
            return $a['level'] <=> $b['level'];
        });

        return [
            'levels' => $progress,
            'totalBusiness' => $totalBusiness,
            'daysElapsed' => $days,
            'nextTarget' => $this->computeNextTarget($totalBusiness, $firstWindowAchieved, $days),
            'daysLeft30' => max(0, 30 - $days),
            'daysLeft60' => max(0, 60 - $days),
            'daysLeft90' => max(0, 90 - $days),
            'currentLevel' => $this->getCurrentLevel($totalBusiness, $days),
        ];
    }

    /**
     * Compute next target for display
     */
    protected function computeNextTarget($totalBusiness, $firstWindowAchieved, $days)
    {
        $targets = $firstWindowAchieved ? [] : [2500, 5000, 10000];
        if (!$firstWindowAchieved && $days > 30 && $days <= 60) $targets[] = 7500;
        if (!$firstWindowAchieved && $days > 60 && $days <= 90) $targets[] = 17500;

        sort($targets);
        foreach ($targets as $t) {
            if ($totalBusiness < $t) return $t;
        }
        return end($targets) ?? null;
    }

    /**
     * Get current achieved level
     */
    protected function getCurrentLevel($totalBusiness, $days)
    {
        if ($totalBusiness >= 10000) return 3;
        if ($totalBusiness >= 5000) return 2;
        if ($totalBusiness >= 2500) return 1;
        return 0;
    }

    /**
     * Check if user is in eligible range for modal display
     */
    public function isInEligibleRange(User $user): bool
    {
        $totalBusiness = $this->computeTotalBusinessDownline($user);
        $days = $user->created_at->diffInDays(now());
        
        // Eligible ranges for modal display
        $eligibleRanges = [
            [2500, 5000],   // Level 1 range
            [5000, 10000],  // Level 2 range
            [10000, PHP_FLOAT_MAX], // Level 3 range
        ];
        
        if ($days > 30 && $days <= 60) {
            $eligibleRanges = [
                [7500, 17500], // Level 2 extended range
            ];
        } elseif ($days > 60 && $days <= 90) {
            $eligibleRanges = [
                [17500, PHP_FLOAT_MAX], // Level 3 extended range
            ];
        }
        
        foreach ($eligibleRanges as $range) {
            if ($totalBusiness >= $range[0] && $totalBusiness < $range[1]) {
                return true;
            }
        }
        
        return false;
    }
}