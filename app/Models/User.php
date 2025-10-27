<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   
    protected $fillable = [
        'sponsor_username',
        'username',
        'full_name',
        'country_code',
        'mobile',
        'email',
        'password',
            'plain_password', // hide from API or array outputs

    ];

    protected $hidden = [
        'password',
        'remember_token',
            'plain_password', // hide from API or array outputs

    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

       public function sponsor()
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    // Direct downlines
    public function referrals()
    {
        return $this->hasMany(User::class, 'sponsor_id');
    }
   
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    // In App\Models\User
    public function levelIncomes()
    {
        return $this->hasMany(LevelIncome::class, 'to_user_id');
    }

    public function levelIncomesGiven()
    {
        return $this->hasMany(LevelIncome::class, 'from_user_id');
    }
     public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function resolvedTickets()
    {
        return $this->hasMany(Ticket::class, 'admin_id');
    }

    public function isAdmin()
    {
        return $this->is_admin === 1;
    }
}
