<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoiIncome extends Model
{
    protected $fillable = [
        'user_id',
        'from_admin',
        'wallet_value',
        'roi_bonus',
        'timing',
    ];
       // Cast timing as datetime
    protected $casts = [
        'timing' => 'datetime',
    ];
}
