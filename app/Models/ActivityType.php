<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable = [
        'activity_type'
    ];

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
}
