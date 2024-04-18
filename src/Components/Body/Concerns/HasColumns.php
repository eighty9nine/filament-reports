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

    public function getNumberOfGroupedCells(
        int $rowIndex,
        string $columnKey,
        string $columnValue
    ) {
        $tableData = $this->data->toArray();
        $numberOfItemsInGroup = $tableData[$rowIndex][$columnKey] == $columnValue ? 1 : 0;

        // count backwards until you meet a different value
        for ($i = $rowIndex - 1; $i > 0; $i--) {
            if ($tableData[$i][$columnKey] == $columnValue) {
                $numberOfItemsInGroup++;
            } else {
                break;
            }
        }

        // count forwards until you meet a different value
        for ($i = $rowIndex + 1; $i < count($tableData); $i++) {
            if ($tableData[$i][$columnKey] == $columnValue) {
                $numberOfItemsInGroup++;
            } else {
                break;
            }
        }

        return $numberOfItemsInGroup;
    }

    public function isFirstWithinGroup(
        int $rowIndex,
        string $columnKey,
        string $columnValue
    ) {
        $tableData = $this->data->toArray();

        if($rowIndex == 0){
            return true;
        }
        try {
            return !($tableData[$rowIndex - 1][$columnKey] == $columnValue);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
