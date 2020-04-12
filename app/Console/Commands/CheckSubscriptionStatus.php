<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use App\Models\Subscription;
use App\Mail\ExpiredNotification;
use App\Contracts\MemberRepositoryContract;
use App\Notifications\SubscriptionUpdateFailed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CheckSubscriptionStatus extends Command
{
    private $error;
    private $users;
    private $members;
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
    protected $description = 'Checks wether or not a member has a valid subscription. Sends and email if not';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MemberRepositoryContract $memberRepo)
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
            $this->members = $this->memberRepo->getWithSubscriptions();
            
            foreach($this->members as $member) {
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
     * @param \App\Models\Member
     * @return boolean
     */
    private function checkMail($member)
    {
        if(!isset($member->email)) {
            $this->error = "$member->first_name $member->last_name" . ' har ingen email og derfor ikke modtaget notifikation om fornyelse af sit medlemsskab';
            Notification::send($this->users, new SubscriptionUpdateFailed(null, $this->error));
            Log::error($this->error);
            return false;
        }
        return true;
    }
}
