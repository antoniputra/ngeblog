<?php

namespace Antoniputra\Ngeblog\Console;

use Carbon\Carbon;
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
    protected $description = 'Publish Ngeblog package configuration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('[' . Carbon::now() . '] Ngeblog : execute migration file');

        // call migration command
        $this->call('migrate');

        // call database seeder
        $this->call('db:seed', ["--class" => "NgeblogTableSeeder"]);

        // publish vendor
        $this->call('vendor:publish', ["--tag" => "ngeblog-assets"]);

        $this->info('[' . Carbon::now() . '] Ngeblog : package configuration has been successfully Installed');
    }
}
