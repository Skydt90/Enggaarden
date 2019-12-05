<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'activity_type_id', 'amount', 'pay_date'
    ];

    protected $dates = [
        'pay_date'
    ];

    public static function boot ()
    {
        parent::boot();

        static::addGlobalScope(function (Builder $builder) {
            return $builder->with('activity_type');
        });
    }

    public function activity_type()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
