<?php

namespace EightyNine\Reports\Components;

use EightyNine\Reports\ComponentContainer;
use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;

class Body extends ComponentContainer
{
    protected array $filters = [];

    public static function make(HasHeader|HasBody|HasFooter $livewire, array $filters = []): static
    {
        $static = app(static::class, ['livewire' => $livewire]);
        $static->configure();
        $static->filters = $filters;

        return $static;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }
}
