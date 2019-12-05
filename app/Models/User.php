<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Tell eloquent to use username as PK
     * and set auto increment to false
     */
    /* protected $primaryKey = 'username';
    public $incrementing = false; */
    
    public const USER_TYPES = [
        'Standard',
        'Administrator'
    ];
    
    protected $fillable = [
        'username', 'password', 'user_type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
