<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Email
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $member_id
 * @property string|null $group
 * @property string $subject
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Member|null $member
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email withRelations()
 * @mixin \Eloquent
 */
class Email extends Model
{
    protected $fillable = [
        'message', 'group', 'user_id', 'subject', 'member_id'
    ];

    // static attributes for server validation
    public const MAIL_GROUPS = [
        'Primære', 'Sekundære', 'Eksterne', 'Bestyrelsen', 'Alle' 
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    //scopes
    public function scopeWithRelations(Builder $query)
    {
       return $query->with(['user', 'member']);
    }
}
