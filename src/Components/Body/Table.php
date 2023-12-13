<?php

namespace EightyNine\Reports\Components\Body;

use EightyNine\Reports\Components\Component;
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

    public function data(Collection $data): static
    {
        $this->data = $data;

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
}

