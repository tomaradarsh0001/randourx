<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoiRate extends Model
{
    use HasFactory;

    protected $fillable = ['rate'];
}
