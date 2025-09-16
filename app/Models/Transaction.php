<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'payment_method',
        'reference_id',
        'screenshot',
        'admin_notes',
        'status',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scope for pending transactions
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for approved transactions
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope for rejected transactions
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Scope for deposits
    public function scopeDeposits($query)
    {
        return $query->where('type', 'deposit');
    }

    // Scope for withdrawals
    public function scopeWithdrawals($query)
    {
        return $query->where('type', 'withdrawal');
    }
}