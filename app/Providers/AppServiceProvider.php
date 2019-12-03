<?php

namespace App\Providers;

use App\Models\Member;
use App\Observers\MemberObserver;
use App\Repositories\AddressRepository;
use App\Repositories\InviteRepository;
use App\Services\InviteService;
use App\Repositories\MemberRepository;
use App\Repositories\SubscriptionRepository;
use App\Services\MemberService;
use App\Repositories\ContributionRepository;
use App\Services\ContributionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // dependency injections
        $this->app->singleton('App\Contracts\MemberRepositoryContract', function($app) {
            return new MemberRepository();
        });

        $this->app->singleton('App\Contracts\AddressRepositoryContract', function($app) {
            return new AddressRepository();
        });

        $this->app->singleton('App\Contracts\SubscriptionRepositoryContract', function($app) {
            return new SubscriptionRepository();
        });

        $this->app->singleton('App\Contracts\MemberServiceContract', function($app) {
            return new MemberService(
                $app->make('App\Contracts\MemberRepositoryContract'), 
                $app->make('App\Contracts\AddressRepositoryContract'), 
                $app->make('App\Contracts\SubscriptionRepositoryContract'));
        }); 

        $this->app->singleton('App\Contracts\InviteRepositoryContract', function($app) {
            return new InviteRepository();
        });

        $this->app->singleton('App\Contracts\InviteServiceContract', function($app) {
            return new InviteService($app->make('App\Contracts\InviteRepositoryContract'));
        }); 

        $this->app->singleton('App\Contracts\ContributionRepositoryContract', function($app) {
            return new ContributionRepository();
        });

        $this->app->singleton('App\Contracts\ContributionServiceContract', function($app) {
            return new ContributionService($app->make('App\Contracts\ContributionRepositoryContract'));
        }); 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // model observers
        Member::observe(MemberObserver::class);
    }
}
