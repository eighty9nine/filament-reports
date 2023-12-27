<?php

namespace EightyNine\Reports\Components\Body\Concerns;

trait HasColumns
{
    protected ?array $columns = [];

    protected bool $hasColumns = false;

    public function columns(array $columns): static
    {
        $this->columns = $columns;
        $this->hasColumns = true;
        $this->hasHeadings = true;

        return $this;
    }

    public function hasColumns(): bool
    {
        return $this->hasColumns;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getColumn(string $column): ?array
    {
        return $this->columns[$column] ?? null;
    }

    public function getColumnByName(string $name): mixed
    {
        return collect($this->columns)->first(fn ($column) => $column->getName() === $name);
    }

    public function getColumnsByName()
    {
        return collect($this->columns)->map(fn ($column) => $column->getName())->toArray();
    }

    public function hasSummary()
    {
        return collect($this->columns)
            ->first(fn ($column) => $column->hasSum()) !== null;
    }
}
