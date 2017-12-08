<?php

namespace Antoniputra\Ngeblog\Tests;

use Antoniputra\Ngeblog\Models\User;
use Orchestra\Testbench\BrowserKit\TestCase as OrchestraTestCase;

// use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\View\Middleware\ShareErrorsFromSession');

        // For faster test when using bcrypt() for user password
        \Hash::setRounds(5);
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('ngeblog.user', User::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            \Antoniputra\Ngeblog\NgeblogServiceProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Ngeblog' => \Antoniputra\Ngeblog\Facade::class,
            'Form'    => \Collective\Html\FormFacade::class,
        ];
    }

    /**
     * Ngeblog Install Command
     *
     * @return void
     */
    protected function installCommand()
    {
        $this->loadLaravelMigrations(['--database' => 'testing']);
        $this->artisan('ngeblog:install', ['--with-dummy' => true]);
    }
}
