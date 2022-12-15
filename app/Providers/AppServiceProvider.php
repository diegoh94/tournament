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
            'App\Repositories\IPlayerRepository',
            'App\Repositories\PlayerRepository'
        );
        
        $this->app->bind(
            'App\Repositories\ITournamentRepository',
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
