<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallPreCommitHook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:commit-hook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        File::put(
            base_path('.git/hooks/pre-commit'),
            File::get(module_path('Core', 'Console/pre-commit'))
        );

        chmod(base_path('.git/hooks/pre-commit'), 0755);
    }
}
