<?php

namespace Antoniputra\Ngeblog;

use Antoniputra\Ngeblog\Ngeblog;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NgeblogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('ngeblog.enabled')) {
            $this->registerRoutes();
            $this->registerResources();
            $this->registerMacros();
        }
    }

    public function register()
    {
        if (!defined('NGEBLOG_PATH')) {
            define('NGEBLOG_PATH', realpath(__DIR__ . '/../'));
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/ngeblog.php', 'ngeblog'
        );

        $this->loadMigrationsFrom(NGEBLOG_PATH . '/database/migrations/');

        app(EloquentFactory::class)->load(NGEBLOG_PATH . '/database');

        $this->app->bind(Ngeblog::class, Ngeblog::class);

        $this->registerPublishes();
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
        $this->loadViewsFrom(__DIR__ . '/../resources/views/themes/bulma-basic', 'ngeblog_public');
    }

    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    protected function registerPublishes()
    {
        $this->publishes([
            NGEBLOG_PATH . '/database/seeds' => base_path('database/seeds'),
        ], 'ngeblog-seeds');

        $this->publishes([
            NGEBLOG_PATH . '/public/css' => public_path('vendor/ngeblog/css'),
            NGEBLOG_PATH . '/public/fonts' => public_path('fonts'),
        ], 'ngeblog-assets');
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

    /**
     * Register any macro
     *
     * @return void
     */
    protected function registerMacros()
    {
        /**
         * @param $text string
         * @param $method string (http verb)
         * @param $action string (is your route/url)
         * @param $attr string (is your attributes like : class, id, etc...)
         * @param $confirm_message string (need confirmation, before firing action ?)
         **/
        \Form::macro('link', function ($text, $method, $action, $attr = array(), $confirm_message = null) {
            // attribute for form
            $formAttr = array('method' => $method, 'url' => $action, 'style' => 'display:inline-block;');
            // append onSubmit
            if ($confirm_message) {
                $formAttr = array_merge($formAttr, array('onsubmit' => 'return confirm("' . $confirm_message . '");'));
            }

            $output = \Form::open($formAttr);
            $output .= '<button type="submit"';

            // give attributes
            if (!empty($attr) and is_array($attr)) {
                foreach ($attr as $key => $value) {
                    if ($key != 'icon') {
                        $output .= ' ' . $key . '="' . $value . '" ';
                    }
                }
            }
            $output .= '>';
            if (isset($attr['icon'])) {
                $output .= $attr['icon'];
            }

            $output .= $text . '</button>';
            $output .= \Form::close();

            return $output;
        });
    }
}
