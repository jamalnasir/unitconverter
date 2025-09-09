<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Laravel;

use Illuminate\Support\ServiceProvider;
use Jamal\UnitConverter\Converter;

class UnitConverterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '\\..\\..\\config\\unit-converter.php', 'unit-converter');
        $this->app->singleton(Converter::class, function ($app) {
            $cfg = $app['config']->get('unit-converter');
            return new Converter();
        });
        $this->app->alias(Converter::class, 'unit-converter');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '\\..\\..\\config\\unit-converter.php' => $this->app->configPath('unit-converter.php'),
        ], 'unit-converter-config');
    }
}
