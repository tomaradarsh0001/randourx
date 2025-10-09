<?php
namespace App\Services;

use App\Models\SalaryIncome;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryIncomeService
{
    protected $businessService;

    public function __construct(BusinessCalculationService $businessService)
    {
        $this->businessService = $businessService;
    }

    /**
     * Compute totalBusinessDownline for a user - now uses pre-calculated value
     */
    public function computeTotalBusinessDownline(User $user): float
    {
        return (float) $user->total_business_downline;
    }

    /**
     * Update level achievements for a user
     */
    public function updateLevelAchievements(User $user): void
    {
        $this->businessService->updateLevelAchievements($user);
    }

    /**
     * Check if all first window levels (1,2,3) are achieved
     */
    public function areAllFirstLevelsAchieved(User $user): bool
    {
        return $user->level_1_achieved && $user->level_2_achieved && $user->level_3_achieved;
    }

    /**
     * Returns thresholds based on achieved levels and time windows
     */
    public function getThresholds(User $user)
    {
        $days = $user->created_at->diffInDays(now());
        
        // Update achievements first
        $this->updateLevelAchievements($user);
        
        // If all first levels are achieved, return only those levels
        if ($this->areAllFirstLevelsAchieved($user)) {
            return [
                ['amount' => 10000, 'percentage' => 20, 'level' => 3],
                ['amount' => 5000,  'percentage' => 10, 'level' => 2],
                ['amount' => 2500,  'percentage' => 5,  'level' => 1],
            ];
        }

        // First 30 days - show all levels
        if ($days <= 30) {
            return [
                ['amount' => 10000, 'percentage' => 20, 'level' => 3],
                ['amount' => 5000,  'percentage' => 10, 'level' => 2],
                ['amount' => 2500,  'percentage' => 5,  'level' => 1],
            ];
        } 
        // 31-60 days - show level 2 extended (7500) if level 2 not achieved in first window
        elseif ($days <= 60) {
            if (!$user->level_2_achieved) {
                return [
                    ['amount' => 7500, 'percentage' => 10, 'level' => 2],
                ];
            } else {
                // If level 2 was achieved, return only achieved levels
                return $this->getAchievedLevelsAsThresholds($user);
            }
        } 
        // 61-90 days - show level 3 extended (17500) if level 3 not achieved in first window
        elseif ($days <= 90) {
            if (!$user->level_3_achieved) {
                return [
                    ['amount' => 17500, 'percentage' => 20, 'level' => 3],
                ];
            } else {
                // If level 3 was achieved, return only achieved levels
                return $this->getAchievedLevelsAsThresholds($user);
            }
        }

        // After 90 days, return only permanently achieved levels
        return $this->getAchievedLevelsAsThresholds($user);
    }

    /**
     * Convert achieved levels to thresholds array
     */
    protected function getAchievedLevelsAsThresholds(User $user): array
    {
        $thresholds = [];
        
        if ($user->level_1_achieved) {
            $thresholds[] = ['amount' => 2500, 'percentage' => 5, 'level' => 1];
        }
        if ($user->level_2_achieved) {
            $thresholds[] = ['amount' => 5000, 'percentage' => 10, 'level' => 2];
        }
        if ($user->level_3_achieved) {
            $thresholds[] = ['amount' => 10000, 'percentage' => 20, 'level' => 3];
        }
        
        return $thresholds;
    }

    public function checkEligibilityFor(User $user)
    {
        $now = now();
        $totalBusiness = $this->computeTotalBusinessDownline($user);
        $wallet3 = (float) $user->wallet3;

        // Update achievements before checking eligibility
        $this->updateLevelAchievements($user);

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
        
        // Update achievements first
        $this->updateLevelAchievements($user);

        $firstWindow = [
            ['amount' => 2500, 'percentage' => 5, 'level' => 1, 'permanent' => true],
            ['amount' => 5000, 'percentage' => 10, 'level' => 2, 'permanent' => true],
            ['amount' => 10000, 'percentage' => 20, 'level' => 3, 'permanent' => true],
        ];

        $progress = [];

        // Show first window levels with their actual achievement status
        foreach ($firstWindow as $level) {
            $isAchieved = false;
            $status = 'pending';
            
            switch ($level['level']) {
                case 1:
                    $isAchieved = $user->level_1_achieved;
                    break;
                case 2:
                    $isAchieved = $user->level_2_achieved;
                    break;
                case 3:
                    $isAchieved = $user->level_3_achieved;
                    break;
            }
            
            if ($isAchieved) {
                $status = 'achieved';
            } else if ($days > 30) {
                $status = 'expired';
            } else {
                $status = 'pending';
            }

            $percent = min(100, round(($totalBusiness / $level['amount']) * 100, 2));

            $progress[] = [
                'level' => $level['level'],
                'amount' => $level['amount'],
                'percentage' => $level['percentage'],
                'status' => $status,
                'percent' => $percent,
                'target' => $level['amount'],
                'permanent' => $level['permanent'],
                'achieved_in_first_30' => $isAchieved,
            ];
        }

        // Show extended windows only if the corresponding level wasn't achieved in first 30 days
        if (!$user->level_2_achieved && $days > 30 && $days <= 60) {
            $status = ($totalBusiness >= 7500) ? 'achieved' : 'pending';
            $progress[] = [
                'level' => 2,
                'amount' => 7500,
                'percentage' => 10,
                'status' => $status,
                'percent' => min(100, round(($totalBusiness / 7500) * 100, 2)),
                'target' => 7500,
                'permanent' => false,
                'achieved_in_first_30' => false,
                'is_extended' => true,
            ];
        }

        if (!$user->level_3_achieved && $days > 60 && $days <= 90) {
            $status = ($totalBusiness >= 17500) ? 'achieved' : 'pending';
            $progress[] = [
                'level' => 3,
                'amount' => 17500,
                'percentage' => 20,
                'status' => $status,
                'percent' => min(100, round(($totalBusiness / 17500) * 100, 2)),
                'target' => 17500,
                'permanent' => false,
                'achieved_in_first_30' => false,
                'is_extended' => true,
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
            'nextTarget' => $this->computeNextTarget($progress, $totalBusiness),
            'daysLeft30' => max(0, 30 - $days),
            'daysLeft60' => max(0, 60 - $days),
            'daysLeft90' => max(0, 90 - $days),
            'currentLevel' => $this->getCurrentLevel($user, $totalBusiness, $days),
            'allFirstLevelsAchieved' => $this->areAllFirstLevelsAchieved($user),
        ];
    }

    /**
     * Compute next target for display
     */
    protected function computeNextTarget($progress, $totalBusiness)
    {
        foreach ($progress as $level) {
            if ($level['status'] === 'pending') {
                if ($totalBusiness < $level['amount']) {
                    return $level['amount'];
                }
            }
        }
        return null;
    }

    /**
     * Get current achieved level
     */
    protected function getCurrentLevel(User $user, $totalBusiness, $days)
    {
        // First check permanently achieved levels
        if ($user->level_3_achieved) return 3;
        if ($user->level_2_achieved) return 2;
        if ($user->level_1_achieved) return 1;

        // Then check current business with time windows
        if ($days <= 30) {
            if ($totalBusiness >= 10000) return 3;
            if ($totalBusiness >= 5000) return 2;
            if ($totalBusiness >= 2500) return 1;
        } elseif ($days <= 60) {
            if ($totalBusiness >= 7500) return 2;
        } elseif ($days <= 90) {
            if ($totalBusiness >= 17500) return 3;
        }
        
        return 0;
    }

    /**
     * Check if user is in eligible range for modal display
     */
    public function isInEligibleRange(User $user): bool
    {
        $totalBusiness = $this->computeTotalBusinessDownline($user);
        $days = $user->created_at->diffInDays(now());
        
        // Update achievements first
        $this->updateLevelAchievements($user);
        
        // If user has permanently achieved levels, they're always eligible
        if ($user->level_1_achieved || $user->level_2_achieved || $user->level_3_achieved) {
            return true;
        }
        
        // Eligible ranges for modal display (only for users without permanent achievements)
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

    /**
     * Get achievement summary for a user
     */
    public function getAchievementSummary(User $user): array
    {
        $this->updateLevelAchievements($user);
        
        return [
            'level_1' => [
                'achieved' => $user->level_1_achieved,
                'achieved_at' => $user->level_1_achieved_at,
                'amount' => 2500,
                'percentage' => 5,
            ],
            'level_2' => [
                'achieved' => $user->level_2_achieved,
                'achieved_at' => $user->level_2_achieved_at,
                'amount' => 5000,
                'percentage' => 10,
            ],
            'level_3' => [
                'achieved' => $user->level_3_achieved,
                'achieved_at' => $user->level_3_achieved_at,
                'amount' => 10000,
                'percentage' => 20,
            ],
            'all_achieved' => $this->areAllFirstLevelsAchieved($user),
            'total_business' => $user->total_business_downline,
            'business_updated_at' => $user->business_updated_at,
        ];
    }

    /**
     * Process salary payout for eligible users
     */
    public function processSalaryPayouts()
    {
        $eligibleUsers = User::where('total_business_downline', '>', 0)
            ->get();

        $payouts = [];
        $totalPayout = 0;

        foreach ($eligibleUsers as $user) {
            $eligibility = $this->checkEligibilityFor($user);
            
            if ($eligibility) {
                // Create salary income record
                $salaryIncome = SalaryIncome::create([
                    'user_id' => $user->id,
                    'amount' => $eligibility['amount'],
                    'percentage' => $eligibility['percentage'],
                    'threshold' => $eligibility['threshold'],
                    'level' => $eligibility['level'],
                    'eligible_at' => $eligibility['eligible_at'],
                    'note' => $eligibility['note'],
                    'type' => 'salary',
                ]);

                // Update user wallet (add to wallet1 as income)
                $user->wallet1 += $eligibility['amount'];
                $user->save();

                $payouts[] = $salaryIncome;
                $totalPayout += $eligibility['amount'];
            }
        }

        return [
            'payouts' => $payouts,
            'total_payout' => $totalPayout,
            'processed_count' => count($payouts),
        ];
    }

    /**
     * Get salary history for a user
     */
    public function getSalaryHistory(User $user, $limit = 10)
    {
        return SalaryIncome::where('user_id', $user->id)
            ->where('type', 'salary')
            ->orderBy('eligible_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get total salary earned by user
     */
    public function getTotalSalaryEarned(User $user): float
    {
        return (float) SalaryIncome::where('user_id', $user->id)
            ->where('type', 'salary')
            ->sum('amount');
    }

    /**
     * Check if user can qualify for extended windows
     */
    public function canQualifyForExtendedWindows(User $user): bool
    {
        $days = $user->created_at->diffInDays(now());
        
        // User can qualify for extended windows if:
        // 1. It's after 30 days
        // 2. Not all first levels are achieved
        return $days > 30 && !$this->areAllFirstLevelsAchieved($user);
    }

    /**
     * Get extended window information
     */
    public function getExtendedWindowInfo(User $user): array
    {
        $days = $user->created_at->diffInDays(now());
        
        if ($days > 30 && $days <= 60 && !$user->level_2_achieved) {
            return [
                'window' => '31-60 days',
                'target' => 7500,
                'percentage' => 10,
                'level' => 2,
                'days_left' => max(0, 60 - $days),
                'description' => 'Extended Level 2 Window'
            ];
        } elseif ($days > 60 && $days <= 90 && !$user->level_3_achieved) {
            return [
                'window' => '61-90 days',
                'target' => 17500,
                'percentage' => 20,
                'level' => 3,
                'days_left' => max(0, 90 - $days),
                'description' => 'Extended Level 3 Window'
            ];
        }
        
        return [
            'window' => 'none',
            'target' => null,
            'percentage' => null,
            'level' => null,
            'days_left' => 0,
            'description' => 'No extended window available'
        ];
    }

    /**
     * Reset user achievements (for testing purposes)
     */
    public function resetUserAchievements(User $user): bool
    {
        try {
            $user->update([
                'level_1_achieved' => false,
                'level_2_achieved' => false,
                'level_3_achieved' => false,
                'level_1_achieved_at' => null,
                'level_2_achieved_at' => null,
                'level_3_achieved_at' => null,
            ]);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}