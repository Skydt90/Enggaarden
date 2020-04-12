<?php

namespace App\Console\Commands;

use App\Contracts\InviteRepositoryContract;
use Illuminate\Console\Command;

class CleanInvites extends Command
{
    private $inviteRepo;
    private $invites;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:clean-invites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears out expired invites from DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InviteRepositoryContract $inviteRepo)
    {
        parent::__construct();
        $this->inviteRepo = $inviteRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->invites = $this->inviteRepo->getAll();

            foreach ($this->invites as $invite) {
                if ($invite->expires_at->isPast()) {
                    $invite->delete();
                }
            }
        } catch(Exception $e) {
            Log::error('CleanInvites: ' . $e);
            Notification::send(User::all(), new InviteCleanupFailed($e));
        }
    }
}
