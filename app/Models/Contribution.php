<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'activity_type_id', 'amount', 'payment_date'
    ];

    protected $dates = [
        'payment_date'
    ];

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
