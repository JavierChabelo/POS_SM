<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Parser as JwtParser; //Se usa para listar los servicios

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // Registrar el parser de JWT
        //$this->app->singleton(JwtParser::class, function ($app) {
        //    return new JwtParser();
        //});
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
