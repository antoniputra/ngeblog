<?php

namespace AntoniPutra\Ngeblog;

use AntoniPutra\Ngeblog\Console\InstallCommand;
use AntoniPutra\Ngeblog\Http\Middleware\AdminAuthorization;
use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Support\Facades\Gate;
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
        $this->bootAdminAssetRoute();
        $this->bootDefaultAuthorization();
        $this->configureCommands();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ngeblog');
    }

    protected function bootPublishable(): void
    {
        $this->publishes([
            __DIR__.'/../config/ngeblog.php' => config_path('ngeblog.php'),
        ], 'ngeblog-config');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'ngeblog-migrations');
    }

    /**
     * Register the Ngeblog public routes.
     *
     * @return void
     */
    protected function bootRoutes(): void
    {
        Route::bind('ngeblogPost', function (string $value) {
            return Post::query()
                ->where(function ($q) use ($value) {
                    $q->where('id', $value)
                        ->orWhere('slug', $value);
                })
                ->firstOrFail();
        });

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

    protected function bootAdminAssetRoute(): void
    {
        Route::get('ngeblog-admin-assets/{filename?}', function ($filename = null) {
            $contentType = 'text/css';
            if (str($filename)->contains('.js')) {
                $contentType = 'text/javascript';
            }

            $content = file_get_contents(__DIR__ .'/../dist/ngeblog-admin-assets/'. $filename);
            return response($content)
                ->header('Content-Type', $contentType);
        })->name('ngeblog-admin-assets');
    }

    protected function bootDefaultAuthorization(): void
    {
        Gate::define('accessNgeblogAdmin', function ($user) {
            return true;
        });
    }

    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
        ]);
    }

}
