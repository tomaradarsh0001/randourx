<?php
// app/Services/BusinessCalculationService.php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BusinessCalculationService
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
     * Check if database column exists
     */
    private function columnExists($table, $column): bool
    {
        try {
            $result = DB::select("SHOW COLUMNS FROM `$table` LIKE '$column'");
            return !empty($result);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update total business downline for all users
     */
    public function updateAllUsersBusiness()
    {
        $users = User::all();
        $updatedCount = 0;

        foreach ($users as $user) {
            $totalBusiness = $this->computeTotalBusinessDownline($user);
            
            // Only update if column exists
            if ($this->columnExists('users', 'total_business_downline')) {
                $user->total_business_downline = $totalBusiness;
                $user->business_updated_at = now();
                $user->save();
            }

            $updatedCount++;
        }

        return $updatedCount;
    }

    /**
     * Update level achievements based on total business
     */
    public function updateLevelAchievements(User $user): array
    {
        $achievements = [];
        $totalBusiness = $this->computeTotalBusinessDownline($user);
        $daysSinceCreation = $user->created_at->diffInDays(now());

        $updates = [];

        // Level 1: 2500
        if ($totalBusiness >= 2500) {
            if ($this->columnExists('users', 'level_1_achieved') && !$user->level_1_achieved) {
                $updates['level_1_achieved'] = true;
                $updates['level_1_achieved_at'] = now();
                $achievements[] = 'level_1';
            }
        }

        // Level 2: 5000
        if ($totalBusiness >= 5000) {
            if ($this->columnExists('users', 'level_2_achieved') && !$user->level_2_achieved) {
                $updates['level_2_achieved'] = true;
                $updates['level_2_achieved_at'] = now();
                $achievements[] = 'level_2';
            }
        }

        // Level 3: 10000
        if ($totalBusiness >= 10000) {
            if ($this->columnExists('users', 'level_3_achieved') && !$user->level_3_achieved) {
                $updates['level_3_achieved'] = true;
                $updates['level_3_achieved_at'] = now();
                $achievements[] = 'level_3';
            }
        }

        // Save if any achievements were updated
        if (!empty($updates)) {
            User::where('id', $user->id)->update($updates);
            $user->refresh();
        }

        return $achievements;
    }

    /**
     * Update achievements for all users
     */
    public function updateAllUsersAchievements()
    {
        $users = User::all();
        $totalAchievements = [];

        foreach ($users as $user) {
            $achievements = $this->updateLevelAchievements($user);
            if (!empty($achievements)) {
                $totalAchievements[$user->id] = $achievements;
            }
        }

        return $totalAchievements;
    }

    /**
     * Get business statistics
     */
    public function getBusinessStats()
    {
        $stats = [
            'total_users' => User::count(),
            'avg_business' => 0,
            'last_updated' => null,
        ];

        if ($this->columnExists('users', 'level_1_achieved')) {
            $stats['users_level_1'] = User::where('level_1_achieved', true)->count();
        }
        if ($this->columnExists('users', 'level_2_achieved')) {
            $stats['users_level_2'] = User::where('level_2_achieved', true)->count();
        }
        if ($this->columnExists('users', 'level_3_achieved')) {
            $stats['users_level_3'] = User::where('level_3_achieved', true)->count();
        }
        if ($this->columnExists('users', 'total_business_downline')) {
            $stats['avg_business'] = User::avg('total_business_downline');
        }
        if ($this->columnExists('users', 'business_updated_at')) {
            $stats['last_updated'] = User::max('business_updated_at');
        }

        return $stats;
    }
}