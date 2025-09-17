<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPurchase;
use App\Models\LevelIncome;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
   public function buyPackage(Request $request)
{
    $request->validate([
        'amount' => 'required|integer|min:10',
    ]);

    $user = Auth::user();
    $amount = $request->amount;

    // Ensure multiples of 10 and not exceeding balance
    if ($amount % 10 !== 0) {
        return back()->with('error', 'Amount must be in multiples of 10.');
    }

    if ($amount > $user->wallet1) {
        return back()->with('error', 'Amount exceeds available balance.');
    }

    // Use transaction to ensure data consistency
    DB::transaction(function () use ($user, $amount) {
        // Deduct from wallet1 and add to wallet3
        $user->wallet1 -= $amount;
        $user->wallet3 += $amount;
        $user->save();

        // Record in user_purchases
        UserPurchase::create([
            'user_id'        => $user->id,
            'purchase_value' => $amount,
            'purchased_at'   => now(),
        ]);

        // Debug: Check if we reach this point
        \Log::info('Purchase completed for user: ' . $user->id . ', amount: ' . $amount);
        
        // Distribute level 1 commission
        $this->distributeLevelCommission($user, $amount);
    });

    return back()->with('success', "Successfully invested $amount USD.");
}

public function levelCommissions(Request $request)
{
    $user = Auth::user();
    
    // Get commission summary by level with more details
    $commissionByLevel = LevelIncome::where('to_user_id', $user->id)
        ->select('level', 
                 DB::raw('SUM(amount) as total_commission'),
                 DB::raw('COUNT(*) as transaction_count'),
                 DB::raw('MAX(created_at) as last_commission'))
        ->groupBy('level')
        ->orderBy('level')
        ->get()
        ->keyBy('level');
    
    // Get total commissions
    $totalCommissions = LevelIncome::where('to_user_id', $user->id)->sum('amount');
    
    // Get monthly commissions
    $monthlyCommissions = LevelIncome::where('to_user_id', $user->id)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('amount');
    
    // Get today's commissions
    $todayCommissions = LevelIncome::where('to_user_id', $user->id)
        ->whereDate('created_at', today())
        ->sum('amount');
    
    // Count active levels (levels that have at least one commission)
    $activeLevelsCount = $commissionByLevel->count();
    
    // Get recent commissions with pagination
    $recentCommissions = LevelIncome::with('fromUser')
        ->where('to_user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('member.wallets.level', compact(
        'totalCommissions',
        'monthlyCommissions',
        'todayCommissions',
        'activeLevelsCount',
        'commissionByLevel',
        'recentCommissions'
    ));
}
public function exportCommissions(Request $request)
{
    $user = Auth::user();
    
    $commissions = LevelIncome::with('fromUser')
        ->where('to_user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    $filename = "commissions_export_" . date('Y-m-d') . ".csv";
    
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    $callback = function() use ($commissions) {
        $file = fopen('php://output', 'w');
        
        // Header row
        fputcsv($file, ['Date', 'From User', 'Level', 'Amount', 'Percentage', 'Description']);
        
        // Data rows
        foreach ($commissions as $commission) {
            fputcsv($file, [
                $commission->created_at->format('Y-m-d H:i'),
                $commission->fromUser->username,
                'Level ' . $commission->level,
                $commission->amount,
                $commission->percentage . '%',
                $commission->description
            ]);
        }
        
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
private function distributeLevelCommission(User $user, $amount)
{
    \Log::info('Starting multi-level commission distribution for user: ' . $user->id);
    
    // Get all upline users with their depth level
    $uplineUsers = $this->getUplineUsers($user);
    
    \Log::info('Upline users found: ' . count($uplineUsers));
    foreach ($uplineUsers as $depth => $uplineUser) {
        $commissionPercentage = $this->getCommissionPercentage($depth);
        $wallet3Upline = $uplineUser->wallet3;
        $procedBal = min($wallet3Upline, $amount);
        $commissionAmount = $procedBal * ($commissionPercentage / 100);


        \Log::info("Level {$depth}: User {$uplineUser->id} gets {$commissionPercentage}% = {$commissionAmount}");
        
        if ($commissionAmount > 0) {
            // Add commission to upline user's wallet2 and income2
            $uplineUser->wallet2 += $commissionAmount;
            $uplineUser->income2 += $commissionAmount;
            $uplineUser->save();
            
            // Record in level_incomes table
            try {
                LevelIncome::create([
                    'from_user_id' => $user->id,
                    'to_user_id'   => $uplineUser->id,
                    'amount'       => $commissionAmount,
                    'percentage'   => $commissionPercentage,
                    'level'        => $depth,
                    'description'  => "Level {$depth} commission from {$user->username}'s purchase of $${amount}"
                ]);
                
                \Log::info("Level {$depth} commission recorded for user: " . $uplineUser->id);
                
            } catch (\Exception $e) {
                \Log::error('Error creating level income record: ' . $e->getMessage());
            }
        }
    }
}

/**
 * Get all upline users with their depth level
 */
private function getUplineUsers(User $user, $maxDepth = 15)
{
    $uplineUsers = [];
    
    // Get the direct referrer first
    $currentUser = $user;
    $depth = 1;
    
    while ($depth <= $maxDepth) {
        $referrer = $this->getDirectReferrer($currentUser);
        
        if (!$referrer) {
            break; // No more upline users
        }
        
        $uplineUsers[$depth] = $referrer;
        $currentUser = $referrer;
        $depth++;
    }
    
    return $uplineUsers;
}

/**
 * Get commission percentage based on depth level
 */
private function getCommissionPercentage($depth)
{
    $commissionStructure = [
        1 => 20.00,  // Level 1: 20%
        2 => 3.00,   // Level 2: 3%
        3 => 2.00,   // Level 3: 2%
        4 => 1.00,   // Level 4: 2%
        5 => 1.00,   // Level 5: 3%
        6 => 0.50,   // Level 6: 0.5%
        7 => 0.50,   // Level 7: 0.5%
        8 => 0.50,   // Level 8: 0.5%
        9 => 0.50,   // Level 9: 0.5%
        10 => 0.50,  // Level 10: 0.5%
    ];
    
    // For levels beyond 10, give 1%
    if ($depth > 10) {
        return 1.00;
    }
    
    return $commissionStructure[$depth] ?? 0.00;
}


private function getDirectReferrer(User $user)
{
    // Method 1: Check if user has a referrer_id field
    if (isset($user->referrer_id) && $user->referrer_id) {
        return User::find($user->referrer_id);
    }
    
    // Method 2: Check downlines table (get the direct upline)
    $referrer = DB::table('downlines')
        ->where('descendant_id', $user->id)
        ->where('depth', 1)
        ->first();
    
    if ($referrer) {
        return User::find($referrer->ancestor_id);
    }
    
    return null;
}
}