<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ActivityType
 *
 * @property int $id
 * @property string $activity_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contribution[] $contributions
 * @property-read int|null $contributions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType whereActivityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
