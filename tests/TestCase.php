<?php

namespace AntoniPutra\Ngeblog\Tests;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase, WithWorkbench;

    protected $enablesPackageDiscoveries = true;

    protected function setUp(): void
    {
        $this->usesTestingFeature(new WithMigration('laravel', 'queue'));

        parent::setUp();

        AliasLoader::getInstance()->setAliases([]);
    }
}