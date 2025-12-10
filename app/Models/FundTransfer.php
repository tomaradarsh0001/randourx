<?php
// app/Models/FundTransfer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'amount',
        'wallet_type',
        'description',
        'status',
        'reference_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relationship with sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // Relationship with receiver
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}