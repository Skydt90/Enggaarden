<?php

namespace App\Providers;

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
        $this->app->singleton('App\Contracts\MemberRepositoryContract', function($app) {
            return new MemberRepository();
        });

        $this->app->bind('App\Contracts\MemberServiceContract', MemberService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
