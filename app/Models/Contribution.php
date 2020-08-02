<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contribution
 *
 * @property int $id
 * @property int $activity_type_id
 * @property float $amount
 * @property \Illuminate\Support\Carbon $pay_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ActivityType $activity_type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereActivityTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution wherePayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contribution whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
