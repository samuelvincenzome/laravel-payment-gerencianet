<?php

namespace samuelvincenzome\gerencianet;

use Gerencianet\Gerencianet;
use Illuminate\Support\ServiceProvider;

class gerencianetServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/gerencianet.php' => config_path('gerencianet.php'),
            ], 'config');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Gerencianet\Gerencianet', function () {
            return new Gerencianet([
                'client_id' => config('gerencianet.client_id'),
                'client_secret' => config('gerencianet.client_secret'),
                'sandbox' => config('gerencianet.sandbox'),
                'timeout' => config('gerencianet.timeout'),
            ]);
        });
    }
}
