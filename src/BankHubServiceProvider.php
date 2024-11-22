<?php
/******************************************************************************
 * @Author                : KienNguyen<letvn.com@gmail.com>                   *
 * @CreatedDate           : 2024-08-30 16:42:02                               *
 * @LastEditors           : KienNguyen<letvn.com@gmail.com>                   *
 * @LastEditDate          : 2024-08-30 16:42:15                               *
 * @FilePath              : packages/bankhub/src/BankHubServiceProvider.php   *
 * @CopyRight             : VietNamPost (vietnampost.vn)                      *
 *****************************************************************************/

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
