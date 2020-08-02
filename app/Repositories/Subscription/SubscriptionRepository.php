<?php

namespace App\Repositories\Subscription;

use App\Models\Subscription;
use App\Repositories\BaseRepo;

class SubscriptionRepository extends BaseRepo implements SubscriptionRepoInterface
{
    /*
     * public function createOnMember($member, $request);

    public function updateByMemberID($request, $id);

    public function getSum();
     *
     * */
    public function __construct($subscription)
    {
        $this->model = $subscription;
    }

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
