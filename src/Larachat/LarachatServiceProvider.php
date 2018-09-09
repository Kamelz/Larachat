<?php 

namespace Kamelz\Larachat;

use Illuminate\Support\ServiceProvider;

class LarachatServiceProvider extends ServiceProvider {


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Regiter migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../database/migrations' => public_path('../database/migrations'),
            ], 'public');


    }
}
