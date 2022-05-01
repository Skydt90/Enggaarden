<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Subscription;
use Illuminate\Console\Command;
use App\Mail\ExpiredNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Repositories\User\UserRepoInterface;
use App\Notifications\SubscriptionUpdateFailed;
use App\Repositories\Member\MemberRepoInterface;

class CheckSubscriptionStatus extends Command
{
    private $count;
    private $users;
    private $members;
    private $userRepo;
    private $memberRepo;

    protected $signature = 'members:check-subscription-status';
    protected $description = 'Checks whether or not a member has a valid subscription. Sends and email if not';

    public function __construct(MemberRepoInterface $memberRepo, UserRepoInterface $userRepo)
    {
        parent::__construct();
        $this->userRepo = $userRepo;
        $this->memberRepo = $memberRepo;
        $this->setupData();
    }

    public function handle()
    {
        Log::info('Running membership check:');

        try {
            $this->members->each(function($member) {
                if ($this->subscriptionWasPayedMoreThanAYearAgo($member)) {
                    Log::info($member->first_name . '\'s medlemskab er udløbet');

                    $this->count++;
                    $member->is_company ? $amount = 300 : $amount = 150;
                    $this->memberRepo->storeSubscriptionOnMember($member, new Subscription(['amount' => $amount]));

                    if ($this->memberHasEmailAddress($member)) {
                        Mail::to($member->email)->queue(new ExpiredNotification($member));
                    }
                }
            });
        } catch (Exception $e) {
            Log::error('CheckSubscriptionStatus: ' . $e);
            Notification::send($this->users, new SubscriptionUpdateFailed($e));
        }
        Log::info("Finished check with: $this->count expirations found");
    }

    private function memberHasEmailAddress($member): bool
    {
        if (!isset($member->email)) {
            $error = "$member->first_name $member->last_name" . ' har ingen email og derfor ikke modtaget notifikation om fornyelse af sit medlemsskab';
            Notification::send($this->users, new SubscriptionUpdateFailed(null, $error));
            Log::error($error);
            return false;
        }
        return true;
    }

    private function setupData()
    {
        $this->count = 0;
        $this->users = $this->userRepo->get();
        $this->members = $this->memberRepo->getWithRelations(['subscriptions']);
    }

    private function subscriptionWasPayedMoreThanAYearAgo($member): bool
    {
        return $member->subscriptions[0]->pay_date && $member->subscriptions[0]->pay_date->addYears(1)->isPast();
    }
}
