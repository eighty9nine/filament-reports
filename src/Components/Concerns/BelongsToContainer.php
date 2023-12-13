<?php

namespace EightyNine\Reports\Components\Concerns;

use EightyNine\Reports\ComponentContainer;
use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;

trait BelongsToContainer
{
    protected ComponentContainer $container;

    public function container(ComponentContainer $container): static
    {
        $this->container = $container;

        return $this;
    }

    public function getContainer(): ComponentContainer
    {
        return $this->container;
    }

    public function getLivewire(): HasHeader|HasBody|HasFooter
    {
        return $this->getContainer()->getLivewire();
    }
}
