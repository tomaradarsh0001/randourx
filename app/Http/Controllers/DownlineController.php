<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DownlineController extends Controller
{
    /**
     * Show logged-in user’s downline.
     */
  public function index()
{
    $user = Auth::user();

    // Fetch all downlines
    $downlines = DB::table('downlines as d')
        ->join('users as u', 'd.descendant_id', '=', 'u.id')
        ->where('d.ancestor_id', $user->id)
        ->where('d.depth', '>', 0)
        ->select(
            'u.id',
            'u.username',
            'u.full_name',
            'u.email',
            'u.wallet3',
            'u.created_at',
            'd.descendant_id',
            'd.depth'
        )
        ->orderBy('d.depth')
        ->orderBy('u.created_at', 'asc')
        ->get();

    // Get all level-1 users
    $level1Users = DB::table('downlines as d')
        ->where('d.ancestor_id', $user->id)
        ->where('d.depth', 1)
        ->pluck('descendant_id')
        ->values();

    // Color palette
    $colorPalette = [
        '#e74c3c', '#3498db', '#2ecc71', '#9b59b6',
        '#f39c12', '#1abc9c', '#e67e22', '#34495e',
    ];

    // Get details for each level-1 user
    $level1Details = DB::table('users')
        ->whereIn('id', $level1Users)
        ->select('id', 'username', 'full_name')
        ->get()
        ->keyBy('id');

    // Assign label + color + user details to each level1
    $level1Groups = [];
    foreach ($level1Users as $index => $id) {
        $userDetails = $level1Details->get($id);
        $username = $userDetails ? $userDetails->username : 'Unknown';
        $fullName = $userDetails ? $userDetails->full_name : 'Unknown';
        
        $level1Groups[$id] = [
            'label' => "Downline " . ($index + 1),
            'username' => $username,
            'full_name' => $fullName,
            'color' => $colorPalette[$index % count($colorPalette)],
        ];
    }

    // Build mapping: descendant → level1 ancestor
    $ancestorMap = DB::table('downlines as d')
        ->whereIn('d.ancestor_id', $level1Users)
        ->where('d.depth', '>=', 0)
        ->pluck('d.ancestor_id', 'd.descendant_id'); 
        // key = descendant, value = its level1 ancestor

    // Attach label + color to all downlines
    foreach ($downlines as $d) {
        $level1Ancestor = $ancestorMap[$d->id] ?? null;

        if ($level1Ancestor && isset($level1Groups[$level1Ancestor])) {
            $d->downline_name = $level1Groups[$level1Ancestor]['label'];
            $d->color = $level1Groups[$level1Ancestor]['color'];
        } else {
            $d->downline_name = "Unknown";
            $d->color = "#7f8c8d"; 
        }
    }

    // Totals
    $totalBusinessDownline = $downlines->sum('wallet3');
    $totalBusiness = $totalBusinessDownline + $user->wallet3;
    $downlineCount = $downlines->count();
    $level1Count = $downlines->where('depth', 1)->count();

    return view('member.downlines.index', compact(
        'downlines',
        'totalBusiness',
        'downlineCount',
        'totalBusinessDownline',
        'user',
        'level1Count',
        'level1Groups' // Added this variable
    ));
}
}
