<?php

namespace EightyNine\Reports\Components\Body\Concerns;

trait CanGroupRows
{
    protected bool $groupRows = false;

    public function groupRows()
    {
        $this->groupRows = true;

        return $this;
    }

    public function areRowsGrouped()
    {
        return $this->groupRows;
    }
}
