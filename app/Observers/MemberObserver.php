<?php

namespace App\Observers;

use App\Mail\ExternalUserInvitation;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;

class MemberObserver
{
    /**
     * Handle the member "created" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function created(Member $member)
    {
        Mail::to($member->email)->queue(new ExternalUserInvitation($member));
    }

    /**
     * Handle the member "updated" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function updated(Member $member)
    {
        //
    }

    /**
     * Handle the member "deleted" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function deleted(Member $member)
    {
        //
    }

    /**
     * Handle the member "restored" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function restored(Member $member)
    {
        //
    }

    /**
     * Handle the member "force deleted" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function forceDeleted(Member $member)
    {
        //
    }
}
