<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Observers\DonationObserver;
use App\Models\Donation;


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

    public function boot()
{
    Donation::observe(DonationObserver::class);
}
}
