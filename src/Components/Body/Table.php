<?php

namespace EightyNine\Reports\Components\Body;

use Closure;
use EightyNine\Reports\Components\Component;
use EightyNine\Reports\ReportsManager;
use Illuminate\Support\Collection;

class Table extends Component
{
    use Concerns\HasHeadings;
    use Concerns\HasColumns;

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
        if ($this->hasColumns()) {
            $this->data = $this->data->map(function ($item) {
                $item = collect($item);
                $item = $item->only($this->getColumnsByName());

                // Reorder the item values based on the column order
                $item = $item->sortBy(function ($value, $column) {
                    return array_search($column, $this->getColumnsByName());
                });

                return $item;
            });
        }

        return $this->data;
    }

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }

    public function getFilters()
    {
        return reports()->getFilterState();
    }
}

