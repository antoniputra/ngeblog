<?php

namespace Antoniputra\Ngeblog\Console;

use Antoniputra\Ngeblog\NgeblogServiceProvider;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ngeblog:install {--with-dummy : Install with dummy data.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Ngeblog package configuration';

    /**
     * The seeder path for ngeblog
     *
     * @var string
     */
    protected $seedersPath = __DIR__ . '/../../seeds/';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Ngeblog: Installation Wizard started...' . PHP_EOL);

        // publish any publishable file
        $this->call('vendor:publish', ['--provider' => NgeblogServiceProvider::class]);

        // call migration command
        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        // call database seeder
        if ($this->option('with-dummy')) {
            $this->_generateDummy();
        } elseif ($this->confirm('Do you wish to generate dummy data?')) {
            $this->_generateDummy();
        }

        $this->info('Ngeblog: package configuration has been successfully installed prend!' . PHP_EOL);
        $this->info('Now you can access your Ngeblog panel at: ' . url('/') . str_start(config('ngeblog.admin_prefix'), '/'));
    }

    /**
     * Prevent error about seeder class not found
     *
     * @param  string $class
     * @return void
     */
    protected function seed($class)
    {
        if (!class_exists($class)) {
            require_once $this->seedersPath . $class . '.php';
        }

        with(new $class())->run();
    }

    /**
     * Generate dummy data
     *
     * @return void
     */
    protected function _generateDummy()
    {
        $this->info('Ngeblog: Generating dummy data prend...' . PHP_EOL);
        $this->seed('NgeblogTableSeeder');
    }
}
