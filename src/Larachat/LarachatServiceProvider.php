<?php 

namespace Vendor\Larachat;

use Illuminate\Support\ServiceProvider;
use Vendor\Larachat\Commands\FooCommand;


class LarachatServiceProvider extends ServiceProvider {

    /**
     * This will be used to register config & view in 
     * your package namespace.
     *
     * 
     * @var  string
     */
    protected $packageName = 'Larachat';

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
                __DIR__.'/../database/migrations' => public_path('vendor/Larachat'),
            ], 'public');


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

}
