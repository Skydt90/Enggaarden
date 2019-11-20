<?php

namespace App\Providers;

use App\Models\Member;
use App\Observers\MemberObserver;
use App\Repositories\MemberRepository;
use App\Services\MemberService;
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

        $this->app->singleton('App\Contracts\MemberServiceContract', function($app) {
            return new MemberService($app->make('App\Contracts\MemberRepositoryContract'));
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
