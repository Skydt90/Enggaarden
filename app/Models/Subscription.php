<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'pay_date'
    ];

    // relationships
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
