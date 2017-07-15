<?php

namespace App\Providers;

use App\Http\Helpers\GeneralInformation;
use Illuminate\Support\ServiceProvider;

class GeneralServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('general',function (){

            return new GeneralInformation();

        });
    }

    public function provides()
    {
        return ['general'];
    }
}
