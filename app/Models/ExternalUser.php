<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\ExternalUser
 *
 * @property int $id
 * @property int $member_id
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $remember_token
 * @property-read \App\Models\Member $member
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalUser withRelations()
 * @mixin \Eloquent
 */
class ExternalUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'external';

    public static function boot()
    {
        parent::boot();

        // Delete invite from db when external user registers
        static::created(function ($externalMember){
            $externalMember->member;
            Invite::where('member_id', $externalMember->member->id)->delete();
        });
    }

    protected $fillable = [
        'email', 'member_id', 'password'
    ];

    // should be hidden from arrays
    protected $hidden = [
        'password'
    ];

    // relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // scopes
    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['member' => function($query) {
            $query->with(['address', 'subscriptions']);
        }]);
    }
}
