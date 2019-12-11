<?php

namespace App\Providers;

use App\Models\Member;
use App\Observers\MemberObserver;
use Illuminate\Support\Facades\Blade;
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

         // blade components
         Blade::component('components.pagination.pages', 'pagination');
         Blade::component('components.pagination.amount', 'amount');
         Blade::component('components.toastr', 'toast');
         Blade::component('components.view-only', 'view');
    }
}
