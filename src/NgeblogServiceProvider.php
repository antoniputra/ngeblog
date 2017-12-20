<?php

namespace Antoniputra\Ngeblog;

use Antoniputra\Ngeblog\Ngeblog;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NgeblogServiceProvider extends ServiceProvider
{
    protected $publishablePath = __DIR__ . '/../publishable';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('ngeblog.enabled')) {
            $this->loadMigrationsFrom($this->publishablePath . '/database/migrations/');
            $this->registerPublishes();
            $this->registerRoutes();
            $this->registerResources();
        }
    }

    public function register()
    {
        if (!defined('NGEBLOG_PATH')) {
            define('NGEBLOG_PATH', realpath(__DIR__ . '/../'));
        }

        $this->mergeConfigFrom(
            $this->publishablePath . '/config/ngeblog.php', 'ngeblog'
        );

        app(EloquentFactory::class)->load($this->publishablePath . '/database/factories');

        $this->app->bind(Ngeblog::class, Ngeblog::class);

        $this->registerCommands();
    }

    /**
     * Register the Ngeblog routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            // 'prefix' => config('ngeblog.admin_prefix'),
            'namespace' => 'Antoniputra\Ngeblog\Http\Controllers',
            'middleware' => 'web',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register the Ngeblog resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ngeblog');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/themes', 'ngeblog_themes');
    }

    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    protected function registerPublishes()
    {
        $this->publishes([
            $this->publishablePath . '/database/seeds' => base_path('database/seeds'),
        ], 'ngeblog-seeds');

        $this->publishes([
            $this->publishablePath . '/assets' => public_path('vendor/ngeblog'),
        ], 'ngeblog-assets');

        $this->publishes([
            $this->publishablePath . '/config/ngeblog.php' => config_path('ngeblog.php'),
        ], 'ngeblog-config');
    }

    /**
     * Register the Ngeblog Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);
        }
    }
}
