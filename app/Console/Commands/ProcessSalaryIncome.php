<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProcessSalaryIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:process-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process salary incomes and repeat entries after 15 days, updating user income3';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("=== Salary Income Cron Started at " . now() . " ===");

        // Fetch ALL latest records (not grouped, but the latest row per user)
        $latestRecords = DB::table('salary_income')
            ->select('salary_income.*')
            ->join(DB::raw('(SELECT user_id, MAX(created_at) as last_entry FROM salary_income GROUP BY user_id) as si2'), function ($join) {
                $join->on('salary_income.user_id', '=', 'si2.user_id')
                     ->on('salary_income.created_at', '=', 'si2.last_entry');
            })
            ->get();

        foreach ($latestRecords as $lastRecord) {
            $lastEntryDate = Carbon::parse($lastRecord->created_at);

            if ($lastEntryDate->addDays(15)->isPast()) {
                // Duplicate the exact record (including description)
                $newCredited = $lastRecord->credited_amount;

                DB::table('salary_income')->insert([
                    'user_id'              => $lastRecord->user_id,
                    'target_level'         => $lastRecord->target_level,
                    'target_amount'        => $lastRecord->target_amount,
                    'user_wallet3_amount'  => $lastRecord->user_wallet3_amount,
                    'calculated_percentage'=> $lastRecord->calculated_percentage,
                    'credited_amount'      => $newCredited,
                    'description'          => $lastRecord->description, // reused
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ]);

                DB::table('users')
                    ->where('id', $lastRecord->user_id)
                    ->increment('income3', $newCredited);

                Log::info("✅ Processed salary income for User ID: {$lastRecord->user_id}, Credited: {$newCredited}, Description: {$lastRecord->description}");
                $this->info("Processed salary income for User ID: {$lastRecord->user_id}");
            } else {
                Log::info("⏭️ Skipped User ID: {$lastRecord->user_id}, last entry not yet 15 days old.");
            }
        }

        Log::info("=== Salary Income Cron Finished at " . now() . " ===");
        $this->info('Salary income processing completed.');
    }
}
