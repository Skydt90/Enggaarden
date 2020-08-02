<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property int|null $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $member_type
 * @property string $is_board
 * @property int $is_company
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Email[] $emails
 * @property-read int|null $emails_count
 * @property-read \App\Models\ExternalUser|null $externalUser
 * @property-read \App\Models\Invite|null $invite
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereIsBoard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereIsCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereMemberType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member withRelations()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member withRelationsWhereSubIsPaid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member withOrderedSubscriptions()
 * @mixin \Eloquent
 */
class Member extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email',
        'phone_number', 'is_board', 'member_type', 'is_company'
    ];

    // static attributes for server validation
    public const MEMBER_TYPES = [
        'Ekstern', 'Sekundær', 'Primær'
    ];

    public const IS_BOARD = [
        'Nej', 'Ja'
    ];

    // relationships
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function externalUser()
    {
        return $this->hasOne(ExternalUser::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function invite()
    {
        return $this->hasOne(Invite::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    //scopes
    public function scopeWithRelations(Builder $query)
    {
       return $query->with(['address', 'subscriptions', 'invite', 'externalUser']);
    }

    public function scopeWithOrderedSubscriptions(Builder $query)
    {
        return $query->whereHas('subscriptions', function($query) {
            $query->latest();
        });
    }

    public function scopeWithRelationsWhereSubIsPaid(Builder $query)
    {
        return $query->with(['subscriptions' => function($query) {
            $query->where('pay_date', '<>', null);
        }]);
    }

    public function latestPayment()
    {
        foreach($this->subscriptions as $subscription) {
            if (isset($subscription->pay_date)) {
                return $subscription;
            }
        }
        return null;
    }

    // adding global scope to sort by newest entry
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function(Builder $query) {
            return $query->orderBy('first_name', 'asc');
        });
    }

}
