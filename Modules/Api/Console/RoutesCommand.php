<?php

declare(strict_types=1);

namespace Modules\Api\Console;

use Illuminate\Console\Command;

class RoutesCommand extends Command
{
    protected $signature = 'openapi:routes';

    protected $description = 'List all registered route with additional information';

    public function handle(): void
    {
        $this->call('route:list');
    }
}
