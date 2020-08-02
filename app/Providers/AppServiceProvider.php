<?php

namespace App\Providers;

use App\Models\Member;
use App\Observers\MemberObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        // Model observers
        Member::observe(MemberObserver::class);

        // Blade component
        Blade::component('components.pagination.pages', 'pagination');
        Blade::component('components.pagination.amount', 'amount');
        Blade::component('components.toastr', 'toast');
        Blade::component('components.view-only', 'view');
    }
}
