<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ExternalUser extends Authenticatable
{

    protected $guard = 'external_user';

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
