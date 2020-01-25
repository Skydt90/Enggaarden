<?php

namespace App\Console;

use App\Mail\ExpiredNotification;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\InviteCleanupFailed;
use App\Notifications\SubscriptionUpdateFailed;
use App\Repositories\InviteRepository;
use App\Repositories\MemberRepository;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // clear expired urls from db
        $schedule->call(function () {
            try {
                $inviteRepository = new InviteRepository();
                $invites = $inviteRepository->getAll();
                
                foreach ($invites as $invite) {
                    if ($invite->expires_at->isPast()) {
                        $invite->delete();
                    }
                }
            } catch(Exception $e) {
                Notification::send(User::all(), new InviteCleanupFailed($e));
                Log::error('Kernel@urls: ' . $e);
            }
        })->everyMinute();//->daily();

        // check if memberships are valid
        $schedule->call(function() {
            try { 
                $memberRepository = new MemberRepository();
                $members = $memberRepository->getWithSubscriptions();

                foreach($members as $member) {
                    if($member->subscriptions[0]->pay_date && $member->subscriptions[0]->pay_date->addYears(2)->isPast()) {
                        $member->is_company ? $amount = 300 : $amount = 100;
                        $memberRepository->storeSubscriptionOnMember($member, new Subscription(['amount' => $amount]));
                        Mail::to($member->email)->queue(new ExpiredNotification($member));
    
                        echo($member->first_name . ' har sidst betalt ' . $member->subscriptions[0]->pay_date->diffForHumans());
                    }
                }
            } catch(Exception $e) {
                Notification::send(User::all(), new SubscriptionUpdateFailed($e));
                Log::error('Kernel@memberships: ' . $e);
            }
        })->everyMinute(); // ->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
