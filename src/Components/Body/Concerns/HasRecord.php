<?php

namespace EightyNine\Reports\Components\Body\Concerns;

trait HasRecord
{
    protected mixed $record = null;

    public function record(mixed $record): static
    {
        $this->record = $record;

        return $this;
    }

    public function getRecord(): mixed
    {
        return $this->record ?? $this->getLayout()?->getRecord();
    }
}
