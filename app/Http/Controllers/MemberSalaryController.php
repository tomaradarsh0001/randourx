<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberSalaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get salary income history
        $salaryHistory = DB::table('salary_income')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('member.salary.index', compact('salaryHistory'));
    }
    
    public function history()
    {
        $user = Auth::user();
        
        $salaryHistory = DB::table('salary_income')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('member.salary.history', compact('salaryHistory'));
    }
}