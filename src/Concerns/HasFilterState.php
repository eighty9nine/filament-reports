<?php

namespace EightyNine\Reports\Concerns;

trait HasFilterState
{
    protected ?array $filterState = [];

    public function setFilterState(array $filterState): static
    {
        $this->filterState = $filterState;

        return $this;
    }

    public function getFilterState(): array
    {
        return $this->filterState;
    }
}
