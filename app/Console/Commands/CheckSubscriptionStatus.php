<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Repositories\Member\MemberRepoInterface;
use Exception;
use App\Models\User;
use App\Models\Subscription;
use App\Mail\ExpiredNotification;
use App\Notifications\SubscriptionUpdateFailed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CheckSubscriptionStatus extends Command
{
    private $users;
    private $memberRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:check-subscription-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks whether or not a member has a valid subscription. Sends and email if not';

    /**
     * Create a new command instance.
     *
     * @param MemberRepoInterface $memberRepo
     */
    public function __construct(MemberRepoInterface $memberRepo)
    {
        parent::__construct();
        $this->memberRepo = $memberRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Running membership check:');

        try {
            $count = 0;
            $this->users = User::all();
            $members = $this->memberRepo->getWithSubscriptions();

            foreach($members as $member) {
                if($member->subscriptions[0]->pay_date && $member->subscriptions[0]->pay_date->addYears(1)->isPast()) {
                    Log::info($member->first_name . '\'s medlemskab er udløbet');

                    $count++;
                    $member->is_company ? $amount = 300 : $amount = 100;
                    $this->memberRepo->storeSubscriptionOnMember($member, new Subscription(['amount' => $amount]));

                    if(!$this->checkMail($member)) {
                        continue;
                    }
                    Mail::to($member->email)->queue(new ExpiredNotification($member));
                }
            }
        } catch(Exception $e) {
            Log::error('CheckSubscriptionStatus: ' . $e);
            Notification::send($this->users, new SubscriptionUpdateFailed($e));
        }
        Log::info("Finished check with: $count expirations found");
    }

    /**
     * Checks if member has an email and notifies accordingly if not
     *
     * @param Member
     * @return boolean
     */
    private function checkMail($member)
    {
        if(!isset($member->email)) {
            $error = "$member->first_name $member->last_name" . ' har ingen email og derfor ikke modtaget notifikation om fornyelse af sit medlemsskab';
            Notification::send($this->users, new SubscriptionUpdateFailed(null, $error));
            Log::error($error);
            return false;
        }
        return true;
    }
}
