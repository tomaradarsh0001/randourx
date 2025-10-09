<?php
// app/Console/Commands/UpdateBusinessAndLevels.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BusinessCalculationService;

class UpdateBusinessAndLevels extends Command
{
    protected $signature = 'business:update';
    protected $description = 'Update total business downline and level achievements for all users';

    protected $businessService;

    public function __construct(BusinessCalculationService $businessService)
    {
        parent::__construct();
        $this->businessService = $businessService;
    }

    public function handle()
    {
        $this->info('Starting business and level updates...');

        // Update total business for all users
        $this->info('Updating total business downline...');
        $updatedCount = $this->businessService->updateAllUsersBusiness();
        $this->info("Processed business for {$updatedCount} users");

        // Update level achievements
        $this->info('Updating level achievements...');
        $achievements = $this->businessService->updateAllUsersAchievements();
        $this->info("New achievements: " . count($achievements));

        // Show statistics
        $stats = $this->businessService->getBusinessStats();
        $this->info('Business Statistics:');
        $this->info("- Total Users: {$stats['total_users']}");
        
        if (isset($stats['users_level_1'])) {
            $this->info("- Level 1 Achieved: {$stats['users_level_1']}");
        }
        if (isset($stats['users_level_2'])) {
            $this->info("- Level 2 Achieved: {$stats['users_level_2']}");
        }
        if (isset($stats['users_level_3'])) {
            $this->info("- Level 3 Achieved: {$stats['users_level_3']}");
        }
        
        $this->info("- Average Business: " . number_format($stats['avg_business'], 2));
        
        if ($stats['last_updated']) {
            $this->info("- Last Updated: {$stats['last_updated']}");
        }

        $this->info('Business and level updates completed successfully!');

        return Command::SUCCESS;
    }
}