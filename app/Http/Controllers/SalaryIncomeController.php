<?php

// app/Http/Controllers/SalaryIncomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryIncome;
use App\Services\SalaryIncomeService;
use Illuminate\Support\Facades\Auth;

class SalaryIncomeController extends Controller
{
    protected $service;

    public function __construct(SalaryIncomeService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $totalBusiness = $this->service->computeTotalBusinessDownline($user);

        $salaryIncomes = SalaryIncome::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Compute progress info for dashboard (helper)
        $progress = $this->computeProgress($user, $totalBusiness);

        return view('member.salary.index', compact('salaryIncomes', 'user', 'totalBusiness', 'progress'));
    }

    protected function computeProgress($user, $totalBusiness)
{
    $daysElapsed = $user->created_at->diffInDays(now());

    $levels = [
        ['amount' => 2500, 'window' => [0,30]],
        ['amount' => 5000, 'window' => [0,30]],
        ['amount' => 10000,'window' => [0,30]],
        ['amount' => 7500, 'window' => [31,60]],
        ['amount' => 17500,'window' => [61,90]],
    ];

    $progress = [];
    foreach ($levels as $level) {
        if ($daysElapsed >= $level['window'][0] && $daysElapsed <= $level['window'][1]) {
            $status = ($totalBusiness >= $level['amount']) ? 'achieved' : 'pending';
        } elseif ($daysElapsed > $level['window'][1]) {
            $status = 'expired';
        } else {
            $status = 'locked';
        }

        $percent = min(100, round(($totalBusiness / $level['amount']) * 100,2));

        $progress[] = [
            'level' => $level['amount'],
            'status' => $status,
            'percent' => $percent,
        ];
    }

    // next target
    $nextTarget = null;
    foreach ($levels as $level) {
        if ($status = 'pending' && $totalBusiness < $level['amount']) {
            $nextTarget = $level['amount'];
            break;
        }
    }
    $nextTarget = $nextTarget ?: end($levels)['amount'];

    return [
        'levels' => $progress,
        'nextTarget' => $nextTarget,
        'totalBusiness' => $totalBusiness,
        'daysElapsed' => $daysElapsed,
        'daysLeft30' => max(0, 30 - $daysElapsed),
        'daysLeft60' => max(0, 60 - $daysElapsed),
        'daysLeft90' => max(0, 90 - $daysElapsed),
    ];
}

}
