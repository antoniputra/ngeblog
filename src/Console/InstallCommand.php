<?php

namespace Antoniputra\Ngeblog\Console;

use Antoniputra\Ngeblog\NgeblogServiceProvider;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

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
    protected $seedersPath = __DIR__ . '/../../publishable/database/seeds/';

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
        $this->info(PHP_EOL . 'Migrating the database tables into your application...');
        $this->call('migrate');

        // dump any file
        $this->info(PHP_EOL . 'Dumping the autoloaded files and reloading all new files...');
        $composer = $this->_findComposer();
        $process = new Process($composer . ' dump-autoload');
        $process->setWorkingDirectory(base_path())->run();

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
    protected function _seed($class)
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
        $this->_seed('NgeblogTableSeeder');
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function _findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }

        return 'composer';
    }
}
