<?php

namespace App\Observers;

use App\Models\Invite;
use App\Models\Member;

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
        Invite::create(['member_id' => $member->id]);
    }
}
