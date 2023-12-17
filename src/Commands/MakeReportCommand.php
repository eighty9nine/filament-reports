<?php

namespace EightyNine\Reports\Commands;

use Filament\Support\Commands\Concerns\CanIndentStrings;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Illuminate\Console\Command;

use function Laravel\Prompts\text;

class MakeReportCommand extends Command
{
    use CanIndentStrings;
    use CanManipulateFiles;

    public $signature = 'make:filament-report {name?}';

    public $description = 'Create a new filament report';

    public function handle(): int
    {

        $report = (string) str(
            $this->argument('name') ??
                text(
                    label: 'What is the page name?',
                    placeholder: 'EditSettings',
                    required: true,
                ),
        )
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');

        $path = (string) str($report)
            ->prepend('/')
            ->prepend(config('filament-reports.reports_directory'))
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $namespace = config('filament-reports.reports_namespace');

        if (! $this->checkForCollision([$path])) {
            $this->copyStubToApp('ReportPage', $path, [
                'namespace' => $namespace,
                'baseReportPage' => 'EightyNine\\Reports\\Report',
                'reportPage' => $report,
                'baseReportPageClass' => 'Report',
                'reportHeading' => 'Report',
                'reportSubHeading' => 'A great report',
            ]);
            $this->components->info("Filament report [{$path}] created successfully.");
        }

        return self::SUCCESS;
    }
}
