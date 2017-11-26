<?php

namespace Antoniputra\Ngeblog\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->loadLaravelMigrations(['--database' => 'testing']);
        $this->artisan('ngeblog:install', ['--with-dummy' => true]);
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // $app['config']->set();
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
            'Form' => \Collective\Html\FormFacade::class,
        ];
    }
}
