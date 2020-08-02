<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Models\Email;
use App\Models\Member;
use App\Models\Invite;
use App\Models\Address;
use App\Models\Contribution;
use App\Models\Subscription;
use App\Models\ActivityType;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepoInterface;
use App\Repositories\Email\EmailRepository;
use App\Repositories\Email\EmailRepoInterface;
use App\Repositories\Invite\InviteRepository;
use App\Repositories\Invite\InviteRepoInterface;
use App\Repositories\Member\MemberRepository;
use App\Repositories\Member\MemberRepoInterface;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepoInterface;
use App\Repositories\Statistic\StatisticsRepository;
use App\Repositories\Statistic\StatisticRepoInterface;
use App\Repositories\Subscription\SubscriptionRepository;
use App\Repositories\Subscription\SubscriptionRepoInterface;
use App\Repositories\ActivityType\ActivityTypeRepository;
use App\Repositories\ActivityType\ActivityTypeRepoInterface;
use App\Repositories\Contribution\ContributionRepository;
use App\Repositories\Contribution\ContributionRepoInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Members
        $this->app->singleton(MemberRepoInterface::class, function() {
            return new MemberRepository(new Member());
        });
        // Addresses
        $this->app->singleton(AddressRepoInterface::class, function() {
            return new AddressRepository(new Address());
        });
        // Subscriptions
        $this->app->singleton(SubscriptionRepoInterface::class, function() {
            return new SubscriptionRepository(new Subscription());
        });
        // Emails
        $this->app->singleton(EmailRepoInterface::class, function() {
            return new EmailRepository(new Email());
        });
        // Invites
        $this->app->singleton(InviteRepoInterface::class, function() {
            return new InviteRepository(new Invite());
        });
        // Contributions
        $this->app->singleton(ContributionRepoInterface::class, function() {
            return new ContributionRepository(new Contribution());
        });
        // ActivityTypes
        $this->app->singleton(ActivityTypeRepoInterface::class, function() {
            return new ActivityTypeRepository(new ActivityType());
        });
        // Users
        $this->app->singleton(UserRepoInterface::class, function() {
            return new UserRepository(new User());
        });
        // Statistics
        $this->app->singleton(StatisticRepoInterface::class, function() {
            return new StatisticsRepository();
        });
    }
}
