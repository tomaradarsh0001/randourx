<?php

// app/Console/Commands/CheckSalaryEligibility.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\SalaryIncome;
use App\Services\SalaryIncomeService;

class CheckSalaryEligibility extends Command
{
    protected $signature = 'salary:check-eligibility';
    protected $description = 'Check user eligibility for salary income and create pending salary_income records';

    protected $service;

    public function __construct(SalaryIncomeService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $this->info('Checking salary eligibility...');

        User::chunk(200, function ($users) {
            foreach ($users as $user) {
                $payload = $this->service->checkEligibilityFor($user);

                if ($payload) {
                    // get last entry of this user for any threshold
                    $lastEntry = SalaryIncome::where('user_id', $user->id)
                        ->latest('eligible_at')
                        ->first();

                    // allow new entry if:
                    // 1. no entry exists
                    // 2. OR last entry is older than 30 days
                    // 3. OR threshold has changed (create instant entry)
                    if (
                        !$lastEntry ||
                        $lastEntry->eligible_at->lte(now()->subDays(30)) ||
                        $lastEntry->threshold != $payload['threshold']
                    ) {
                        // If threshold changed, we might want to log this
                        if ($lastEntry && $lastEntry->threshold != $payload['threshold']) {
                            $this->info("Threshold changed for user {$user->id}: {$lastEntry->threshold} -> {$payload['threshold']}. Creating instant entry.");
                        }
                        
                        SalaryIncome::create($payload);
                        $this->info("Created pending salary for user {$user->id} amount {$payload['amount']} with threshold {$payload['threshold']}");
                    }
                }
            }
        });

        $this->info('Eligibility check complete.');
    }
}