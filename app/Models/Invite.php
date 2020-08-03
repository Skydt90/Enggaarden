<?php

namespace App\Models;

use App\Mail\InviteExistingMember;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExternalUserInvitation;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Invite
 *
 * @property int $id
 * @property int $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon $expires_at
 * @property-read \App\Models\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Invite extends Model
{
    protected $fillable = [
        'member_id', 'expires_at'
    ];

    protected $dates = [
        'expires_at'
    ];

    // Bør flyttes til en InviteObserver for consistency - chr
    public static function boot()
    {
        parent::boot();

        static::creating(function($invite) {
            $invite->member;

            $expire = now()->addWeek();
            $invite->expires_at = $expire;
            $link = URL::temporarySignedRoute('reg-ext', $expire, ['id' => $invite->member->id, 'email' => $invite->member->email]);

            if ($invite->member->created_at->addMinute()->isPast()) {
                Mail::to($invite->member->email)->queue(new InviteExistingMember($invite->member, $link, $expire));
            } else {
                Mail::to($invite->member->email)->queue(new ExternalUserInvitation($invite->member, $link, $expire));
            }
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
