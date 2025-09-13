<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'purchase_value',
        'purchased_at',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];
}
