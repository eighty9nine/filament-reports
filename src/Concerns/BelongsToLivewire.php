<?php

namespace EightyNine\Reports\Concerns;

use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;

trait BelongsToLivewire
{
    protected HasHeader|HasBody|HasFooter $livewire;

    public function livewire(HasHeader|HasBody|HasFooter $livewire): static
    {
        $this->livewire = $livewire;

        return $this;
    }

    public function getLivewire(): HasHeader|HasBody|HasFooter
    {
        return $this->livewire;
    }
}
