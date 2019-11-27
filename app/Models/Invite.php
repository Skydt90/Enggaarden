<?php

namespace App\Models;

use App\Mail\ExternalUserInvitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class Invite extends Model
{
    protected $fillable = [
        'member_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($invite){
            $invite->member;

            $expire = now()->addMonth();
            $link = URL::temporarySignedRoute('reg-ext', $expire, ['id' => $invite->member->id, 'email' => $invite->member->email]);
        
            Mail::to($invite->member->email)->queue(new ExternalUserInvitation($invite->member, $link, $expire));
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
