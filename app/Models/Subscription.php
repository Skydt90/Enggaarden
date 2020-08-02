<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property int|null $member_id
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $pay_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Member|null $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription wherePayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
