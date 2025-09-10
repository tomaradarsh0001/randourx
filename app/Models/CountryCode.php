<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $table = 'country_codes';
    protected $fillable = [
        'country_code',
        'country_code_name_in_short',
        'country_code_with_plus',
        'country_name',
    ];
}
