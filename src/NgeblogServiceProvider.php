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
            __DIR__.'/../dist' => public_path('/'),
        ], 'ngeblog-assets');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // $this->publishesMigrations([
        //     __DIR__.'/../database/migrations' => database_path('migrations'),
        // ], 'ngeblog-migrations');

        // $this->publishes([
        //     __DIR__.'/../database/migrations/001_create_post_tag_table.php' => database_path('migrations'),
        //     __DIR__.'/../database/migrations/002_create_posts_table.php' => database_path('migrations'),
        //     __DIR__.'/../database/migrations/003_create_tags_table.php' => database_path('migrations'),
        // ], 'ngeblog-migrations');
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

        // * Route for admin asset
        Route::get('resolve-ngeblog-dist/{filename?}', function ($filename = null) {

            $contentType = 'text/css';
            if (str($filename)->contains('.js')) {
                $contentType = 'text/javascript';
            }

            $content = file_get_contents(__DIR__ .'/../dist/resolve-ngeblog-dist/'. $filename);
            return response($content)
                ->header('Content-Type', $contentType);
        })->name('resolve-ngeblog-dist');

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
