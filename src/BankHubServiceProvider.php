<?php

namespace BankHub;

use Illuminate\Support\ServiceProvider;

class BankHubServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge configuration file
        $this->mergeConfigFrom(
            __DIR__.'/../config/bankhub.php', 'bankhub'
        );
    }

    // php artisan vendor:publish --provider="Tkien\BankHub\BankHubServiceProvider"
    public function boot()
    {
        // Publish configuration file
        $this->publishes([
            __DIR__.'/../config/bankhub.php' => config_path('bankhub.php'),
        ]);
    }
}
