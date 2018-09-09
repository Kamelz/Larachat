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

        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
                        __DIR__.'/../database/migrations/create_messages_tables.php.stub' => public_path('../database/migrations')."/{$timestamp}_create_messages_tables.php",
                    ], 'migrations');


    }
}
