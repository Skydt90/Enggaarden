<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExternalUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'external';

    protected $fillable = [
        'email', 'member_id', 'password'
    ];

    // should be hidden from arrays
    protected $hidden = [
        'password'
    ];

    // relationships
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
