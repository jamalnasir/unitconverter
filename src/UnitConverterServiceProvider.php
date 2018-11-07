<?php

namespace Jamal\UnitConverter;

use Illuminate\Support\ServiceProvider;

class UnitConverterServiceProvider extends ServiceProvider
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
        $this->app->singleton(UnitConverter::class, function () {
            return new UnitConverter();
        });

        $this->app->alias(UnitConverter::class, 'unit-converter');
    }

}
