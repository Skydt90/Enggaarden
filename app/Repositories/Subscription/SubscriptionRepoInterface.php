<?php


namespace App\Repositories\Subscription;


use App\Repositories\BaseRepoInterface;

interface SubscriptionRepoInterface extends BaseRepoInterface
{
    public function updateByMemberID($request, $id);
    public function getTotalSubscriptionSum();
}
