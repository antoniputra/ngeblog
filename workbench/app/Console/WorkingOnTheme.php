<?php

namespace Workbench\App\Console;

use Illuminate\Console\Command;

class WorkingOnTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ngeblog:working-on-theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command intended for people who constribute to make changes for theme. Basically it will copy latest `stubs` folder into Laravel `workbench/` directory.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    }
}
