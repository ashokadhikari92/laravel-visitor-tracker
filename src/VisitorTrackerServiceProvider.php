<?php

namespace Voerro\Laravel\VisitorTracker;

use Illuminate\Support\ServiceProvider;

class VisitorTrackerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VisitStats::class, function () {
            return new VisitStats();
        });

        $this->app->alias(VisitStats::class, 'laravel-visitor-tracker');

        if ($this->app->config->get('visitortracker') === null) {
            $this->app->config->set('visitortracker', require __DIR__ . '/config/visitortracker.php');
        }
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'visitstats');

        $this->publishes([
            __DIR__ . '/config/visitortracker.php' => config_path('visitortracker.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/visitortracker'),
        ], 'public');
    }
}
