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
                // get last entry of this user for the same threshold
                $lastEntry = SalaryIncome::where('user_id', $user->id)
                    ->where('threshold', $payload['threshold'])
                    ->latest('eligible_at')
                    ->first();

                // allow new entry if:
                // 1. no entry exists
                // 2. OR last entry is older than 30 days
                if (
                    !$lastEntry ||
                    $lastEntry->eligible_at->lte(now()->subDays(30))
                ) {
                    SalaryIncome::create($payload);
                    $this->info("Created pending salary for user {$user->id} amount {$payload['amount']}");
                }
            }
        }
    });

    $this->info('Eligibility check complete.');
}

}
