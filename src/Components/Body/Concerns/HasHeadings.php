<?php

namespace EightyNine\Reports\Components\Body\Concerns;

trait HasHeadings
{

    protected ?array $headings = [];

    protected bool $hasHeadings = false;

    protected bool $firstColumnAsHeadings = false;

    public function useKeysAsHeadings(): static
    {
        $this->headings = collect($this->data->first())
            ->keys()
            ->map(fn ($key) => ucwords($key))
            ->toArray();
        $this->hasHeadings = true;
        return $this;
    }

    public function useFirstColumnAsHeadings()
    {
        $this->firstColumnAsHeadings = true;
        return $this;
    }

    public function isFirstColumnUsedAsHeadings(): bool
    {
        return $this->firstColumnAsHeadings;
    }

    public function hasHeadings(): bool
    {
        return $this->hasHeadings;
    }

    public function getHeadings(): array
    {
        $this->hasHeadings = true;
        return $this->headings;
    }
}
