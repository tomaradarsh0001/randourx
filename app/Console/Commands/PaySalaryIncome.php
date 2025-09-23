<?php
// app/Console/Commands/PaySalaryIncome.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SalaryIncome;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaySalaryIncome extends Command
{
    protected $signature = 'salary:pay';
    protected $description = 'Pay pending salary incomes which are older than 15 days';

    public function handle()
{
    $this->info('Processing salary payments...');
    
    // TEMP: for testing, pay immediately
    $cutoff = Carbon::now()->subSeconds(0);

    $pending = SalaryIncome::where('status', 'pending')
        ->where('eligible_at', '<=', $cutoff)
        ->get();

    foreach ($pending as $item) {
        DB::transaction(function() use ($item) {
            $user = $item->user()->lockForUpdate()->first();
            $user->income3 = (float)$user->income3 + (float)$item->amount;
            $user->save();

            $item->status = 'paid';
            $item->paid_at = now();
            $item->save();
        });

        $this->info("✅ Paid salary id {$item->id} for user {$item->user_id}, amount={$item->amount}");
    }
}

}
