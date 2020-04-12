<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Contracts\SubscriptionRepositoryContract;

class SubscriptionRepository implements SubscriptionRepositoryContract
{
    public function createOnMember($member, $request)
    {
        $subscription = Subscription::make($request->all());
        $member->subscriptions()->save($subscription);
        $member->setRelation('subscriptions', $subscription);
        return $member;
    }

    public function updateByMemberID($request, $id)
    {
        $subscription = Subscription::where('member_id', '=', $id)->firstOrFail();
        $subscription ->fill($request->validated());
        $subscription ->save();
        return $subscription;
    }

    public function getSum()
    {
        $total = 0;
        Subscription::latest()->get()->filter(function($sub) {
            if ($sub->pay_date != null) {
                return $sub->amount;
            }
        })->each(function($sub) use(&$total) {
            $total += $sub->amount;
        });
        return $total;
    }
}