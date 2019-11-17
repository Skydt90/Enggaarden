<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalUser extends Model
{
    protected $fillable = [
        'email', 'member_id', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    // relationships
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
