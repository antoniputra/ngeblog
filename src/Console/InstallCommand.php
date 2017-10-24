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
    protected $description = 'Install the Ngeblog package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Execute migrate first, migrating...');
        $this->call('migrate');
        $this->call('db:seed', ["--class" => "NgeblogTableSeeder"]);
        $this->call('vendor:publish', ["--tag" => "ngeblog-assets"]);
        $this->info('Ngeblog Package has been successfully Installed Prend!');
    }
}
