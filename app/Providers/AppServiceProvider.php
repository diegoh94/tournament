<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\PlayerRepositoryInterface',
            'App\Repositories\PlayerRepository'
        );
        
        $this->app->bind(
            'App\Repositories\TournamentRepositoryInterface',
            'App\Repositories\TournamentRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
