<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Notifications\InviteCleanupFailed;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Invite\InviteRepoInterface;

class CleanInvites extends Command
{
    private $inviteRepo;
    protected $signature = 'members:clean-invites';
    protected $description = 'Clears out expired invites from DB';

    public function __construct(InviteRepoInterface $inviteRepo)
    {
        parent::__construct();
        $this->inviteRepo = $inviteRepo;
    }

    public function handle()
    {
        try {
            $invites = $this->inviteRepo->get();

            foreach ($invites as $invite) {
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
