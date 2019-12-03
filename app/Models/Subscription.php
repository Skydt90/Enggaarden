<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'pay_date', 'amount', 'member_id'
    ];

    protected $dates = [
        'pay_date'
    ];

    
    // relationships
    public function member() {
        return $this->belongsTo(Member::class);
    }

    // adding global scope to sort by newest entry
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function(Builder $query) {
            return $query->orderBy(static::CREATED_AT, 'desc');
        });
    }
}
