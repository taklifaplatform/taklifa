<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;

class CodeCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'code:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Code Quality & Fix Issues.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // $this->call('ide-helper:models', [
        //     '--dir' => "Modules/*/Entities",
        // ]);

        // exec('./artisan ide-helper:models --dir="Modules/*/Entities"');
        exec('./vendor/bin/rector process Modules/');
        exec('./vendor/bin/pint');
    }
}
