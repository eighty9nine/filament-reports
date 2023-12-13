<?php

namespace EightyNine\Reports\Components\Body;

use Closure;
use EightyNine\Reports\Components\Component;
use EightyNine\Reports\ReportsManager;
use Illuminate\Support\Collection;

class Table extends Component
{
    use Concerns\HasHeadings;

    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.body.table';

    protected Collection $data;

    public function __construct()
    {
    }

    public function data(Closure $dataClosure): static
    {
        $this->data = $this->evaluate($dataClosure);

        return $this;
    }

    public function getData(): Collection
    {
        return $this->data;
    }

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }

    public function getFilters()
    {
        return ReportsManager::getInstance()->getFilterState();
    }
}

