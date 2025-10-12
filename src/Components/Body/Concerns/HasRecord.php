<?php

namespace EightyNine\Reports\Components\Body\Concerns;

trait HasRecord
{
    protected mixed $record = null;

    protected ?string $recordKey = null;

    public function record(mixed $record): static
    {
        $this->record = $record;

        return $this;
    }

    public function recordKey(?string $recordKey): static
    {
        $this->recordKey = $recordKey;

        return $this;
    }

    public function getRecordKey(): ?string
    {
        return $this->recordKey;
    }

    public function getRecord(): mixed
    {
        return $this->record ?? $this->getLayout()?->getRecord();
    }
}
