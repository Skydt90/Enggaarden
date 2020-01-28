<?php

namespace App\Repositories;

use App\Contracts\SubscriptionRepositoryContract;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

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
        //return DB::select('select SUM(subscriptions.amount) as sum from subscriptions where subscriptions.pay_date IS NOT NULL')[0];
    }
}