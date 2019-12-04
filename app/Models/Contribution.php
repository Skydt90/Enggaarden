<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'activity_type_id', 'amount', 'pay_date'
    ];

    protected $dates = [
        'pay_date'
    ];

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
