<?php

// app/Models/SalaryIncome.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryIncome extends Model
{
    protected $fillable = [
        'user_id','amount','percentage','threshold','status','eligible_at','paid_at','period_start','period_end','note'
    ];

    protected $casts = [
        'eligible_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
