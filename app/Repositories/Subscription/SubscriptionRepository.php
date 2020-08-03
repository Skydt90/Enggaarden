<?php

namespace App\Repositories\Subscription;

use App\Repositories\BaseRepo;

class SubscriptionRepository extends BaseRepo implements SubscriptionRepoInterface
{

    public function __construct($subscription)
    {
        $this->model = $subscription;
    }

    public function updateByMemberID($request, $id)
    {
        $subscription = $this->model->firstOrCreate(['member_id' => $id]);
        $subscription->fill($request->validated());
        $subscription->save();
        return $subscription;
    }

    public function getTotalSubscriptionSum()
    {
        $total = 0;
        $this->model->latest()->get()->filter(function($sub) {
            if ($sub->pay_date != null) {
                return $sub->amount;
            } return false;
        })->each(function($sub) use(&$total) {
            $total += $sub->amount;
        });
        return $total;
    }
}
