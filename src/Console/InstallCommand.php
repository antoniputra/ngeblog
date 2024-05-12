<?php

namespace AntoniPutra\Ngeblog\Console;

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
    protected $description = 'Install the Ngeblog package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO Finish copyo from stubs into Consumer directory

        // TODO - Copy routes/ngeblog.php from stubs.
        // ...
        
        // TODO - Copy Controllers file from stubs.
        // copy(__DIR__ .'/../../stubs/Http/Controllers/', '');

        // TODO - Copy blade views file from stubs
        // ...
    }
}
