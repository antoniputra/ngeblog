<?php

namespace AntoniPutra\Ngeblog\Console;

use AntoniPutra\Ngeblog\NgeblogServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\confirm;

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
    protected $description = 'Install the Ngeblog admin panel and resources.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Schema::hasTable('ngeblog_posts') && file_exists(config_path('ngeblog.php'))) {
            if (! $this->confirm('It seems this package is already installed. Would you like to proceed with the installation anyway?')) {
                return;
            }
        }

        $this->line('');
        $this->call('vendor:publish', ['--provider' => NgeblogServiceProvider::class]);

        $this->line('');
        $this->runDatabaseMigrations();

        $this->line('');
        $this->installStarterPage();

        $this->line('');
        $this->components->info('Installation completed. You might access admin panel here: '. route('ngeblog.index'));
    }

    protected function runDatabaseMigrations()
    {
        if (confirm('New database migrations were added. Would you like to run your migrations?', true)) {
            $this->call('migrate', ['--force' => true]);
        }
    }

    protected function installStarterPage()
    {
        $confirmed = confirm(
            label: 'Do you want to install Starter Page?',
            default: true,
            yes: 'Yep, Please!',
            no: 'Nope.',
            hint: 'It will give you "'. config('app.url') .'/blogs" with default basic layout written in blade syntax.'
        );

        if (! $confirmed) {
            return;
        }

        copy(__DIR__ .'/../../stubs/Http/Controllers/NgeblogPostController.php', app_path('Http/Controllers/NgeblogPostController.php'));
        
        (new Filesystem)->copyDirectory(__DIR__ .'/../../stubs/ngeblog', resource_path('views/ngeblog'));

        // TODO - Copy routes/ngeblog.php from stubs
        // TODO - and write require inside web.php of consumer.
        copy(__DIR__ .'/../../stubs/routes/ngeblog.php', base_path('routes/ngeblog.php'));
        (new Filesystem)->append(
            base_path('routes/web.php'),
            $this->publicPageRouteDefinition()
        );

        $this->info('√ [StarterPage] Controller generated "app/Http/Controllers/NgeblogPostController.php"'. PHP_EOL);
        $this->info('√ [StarterPage] View generated "resources/views/ngeblog/*"'. PHP_EOL);

        $this->info('√ [StarterPage] Route generated "routes/ngeblog.php" and included to your "routes/web.php"'. PHP_EOL);

        $this->components->info('Ngeblog Starter Page generated successfully.');
    }

    protected function publicPageRouteDefinition()
    {
        return <<<'EOF'

require __DIR__.'/ngeblog.php';

EOF;
    }
}
