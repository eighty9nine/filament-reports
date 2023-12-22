<?php

namespace EightyNine\Reports\Components\Body\Concerns;

trait HasSum
{
    protected bool|Closure $hasSum = false;

    public function sum(bool|\Closure $condition = true): static
    {
        $this->hasSum = $condition;

        return $this;
    }

    public function hasSum(): bool|Closure
    {
        return $this->hasSum;
    }
}
