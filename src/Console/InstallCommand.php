<?php

namespace Antoniputra\Ngeblog\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ngeblog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Ngeblog package configuration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Ngeblog: Installation Wizard started...' . PHP_EOL);

        // call migration command
        $this->call('migrate');

        // publish any publishable file
        $this->call('vendor:publish', ["--tag" => "ngeblog-config"]);
        $this->call('vendor:publish', ["--tag" => "ngeblog-seeds"]);
        $this->call('vendor:publish', ["--tag" => "ngeblog-assets"]);

        // call database seeder
        if ($this->confirm('Do you wish to generate dummy data?')) {
            $this->info('Ngeblog: Generating dummy data prend...' . PHP_EOL);
            $this->call('db:seed', ["--class" => "NgeblogTableSeeder"]);
        }

        $this->info('Ngeblog: package configuration has been successfully installed prend!' . PHP_EOL);
        $this->info('Now you can access your blog panel under uri: ' . str_start(config('ngeblog.admin_prefix'), '/'));
    }
}
