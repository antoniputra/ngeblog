<?php

namespace AntoniPutra\Ngeblog;

use AntoniPutra\Ngeblog\Http\Middleware\AdminAuthorization;
use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class NgeblogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ngeblog.php', 'ngeblog'
        );
    }

    public function boot(): void
    {
        $this->bootPublishable();
        $this->bootRoutes();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ngeblog');
    }

    protected function bootPublishable()
    {
        $this->publishes([
            __DIR__.'/../config/ngeblog.php' => config_path('ngeblog.php'),
        ], 'ngeblog-config');

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/ngeblog'),
        ], 'ngeblog-assets');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'ngeblog-migrations');
    }

    /**
     * Register the Ngeblog public routes.
     *
     * @return void
     */
    protected function bootRoutes()
    {
        if ($this->app instanceof CachesRoutes && $this->app->routesAreCached()) {
            return;
        }

        Route::group([
            'domain' => config('ngeblog.domain', null),
            'prefix' => config('ngeblog.path'),
            'middleware' => config('ngeblog.middleware', [
                'web',
                AdminAuthorization::class
            ]),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        });
    }
}
