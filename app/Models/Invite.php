<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'member_id'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
