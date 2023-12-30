<?php

declare(strict_types = 1);

namespace Centrex\Meta\Commands;

use Illuminate\Console\Command;

class MetaCommand extends Command
{
    public $signature = 'laravel-model-meta';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
