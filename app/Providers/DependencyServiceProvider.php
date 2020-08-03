<?php

namespace App\Providers;

use App\Repositories\User\UserRepoInterface;
use Illuminate\Support\ServiceProvider;

use App\Services\Email\EmailService;
use App\Services\Email\EmailServiceInterface;
use App\Services\Invite\InviteService;
use App\Services\Invite\InviteServiceInterface;
use App\Services\Member\MemberService;
use App\Services\Member\MemberServiceInterface;
use App\Services\Contribution\ContributionService;
use App\Services\Contribution\ContributionServiceInterface;
use App\Repositories\Email\EmailRepoInterface;
use App\Repositories\Member\MemberRepoInterface;
use App\Repositories\Invite\InviteRepoInterface;
use App\Repositories\Address\AddressRepoInterface;
use App\Repositories\Contribution\ContributionRepoInterface;
use App\Repositories\ActivityType\ActivityTypeRepoInterface;
use App\Repositories\Subscription\SubscriptionRepoInterface;

class DependencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Members
        $this->app->singleton(MemberServiceInterface::class, function($app) {
            return new MemberService(
                $app->make(MemberRepoInterface::class),
                $app->make(AddressRepoInterface::class),
                $app->make(SubscriptionRepoInterface::class));
        });
        // Emails
        $this->app->singleton(EmailServiceInterface::class, function($app) {
            return new EmailService(
                $app->make(EmailRepoInterface::class),
                $app->make(MemberRepoInterface::class),
                $app->make(UserRepoInterface::class));
        });
        // Invites
        $this->app->singleton(InviteServiceInterface::class, function($app) {
            return new InviteService(
                $app->make(InviteRepoInterface::class));
        });
        // Contributions
        $this->app->singleton(ContributionServiceInterface::class, function($app) {
            return new ContributionService(
                $app->make(ContributionRepoInterface::class),
                $app->make(ActivityTypeRepoInterface::class)
            );
        });
    }
}
