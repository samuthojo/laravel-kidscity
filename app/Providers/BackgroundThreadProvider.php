<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackgroundThreadProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $exitCode = Artisan::call('queue:work', [
         '--timeout' => 60,
      ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
