<?php

namespace App\Providers;

use App\Models\PermitService;
use App\Observers\PermitServiceObserver;
use Illuminate\Support\ServiceProvider;
use App\Services\PermitLeaveService;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        PermitService::observe(PermitServiceObserver::class);
        if (!app()->runningInConsole()) {
            app(\App\Services\PermitLeaveService::class)->expireIfNeeded();
        }
    }
}
