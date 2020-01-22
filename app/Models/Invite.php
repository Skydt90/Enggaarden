<?php

namespace App\Models;

use App\Mail\ExternalUserInvitation;
use App\Mail\InviteExistingMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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

            if($invite->member->created_at->addDay()->isPast()) {
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
