<?php

namespace Antoniputra\Ngeblog\Tests;

use Orchestra\Testbench\TestCase;

class FeatureTestCase extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		$this->_installCommand();
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

    protected function _installCommand()
    {
    	$this->artisan('migrate');
    }
}
