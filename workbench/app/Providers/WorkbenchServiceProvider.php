<?php

namespace Workbench\App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(true);

        /**
         * For development only.
         * To make sure when Contributors run `composer serve`
         * Package tables are set properly.
         */
        $this->loadMigrationsFrom(__DIR__ .'/../../../database/migrations');

        Gate::define('accessNgeblogAdmin', function ($user) {
            return true;
        });
    }
}
