<?php

namespace EightyNine\Reports\Commands;

use Illuminate\Console\Command;

class ReportsCommand extends Command
{
    public $signature = 'filament-reports';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
