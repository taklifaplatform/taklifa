<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'module:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Setup.';

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
        // prevent resetting data on production
        if (app()->environment('production')) {
            $this->error('You are not allowed to run this command in production.');

            return;
        }

        try {
            $this->call('media-library:clear');
        } catch (\Throwable $throwable) {
            //throw $th;
        }

        $this->call('db:wipe');
        $this->call('migrate');
        $this->call('module:migrate');

        try {
            if (! env('APP_KEY', null)) {
                $this->call('key:generate');
            }
        } catch (\Throwable $throwable) {
            //throw $th;
        }

        $this->call('module:seed');
        $this->call('db:seed');
    }
}
