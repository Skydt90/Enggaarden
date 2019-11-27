<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    
    protected $fillable = [
        'first_name', 'last_name', 'email',
        'phone_number', 'is_board', 'member_type', 'is_company'
    ];

    
    // static attributes for server validation
    public const MEMBER_TYPES = [
        'Ekstern', 'Sekundær', 'Primær'
    ];

    public const IS_BOARD = [
        'Nej', 'Ja'
    ];


    // relationships
    public function address() {
        return $this->hasOne(Address::class);
    }

    public function externalUser() {
        return $this->hasOne(ExternalUser::class);
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function invite() {
        return $this->hasOne(Invite::class);
    }

    //scopes
    public function scopeWithRelations(Builder $query){
       return $query->with(['address', 'subscriptions', 'invite', 'externalUser']);
    }

}
