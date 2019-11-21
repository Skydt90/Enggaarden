<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    // scopes
    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['member' => function($query) {
            $query->with(['address', 'subscriptions']);
        }]);
    }
}
