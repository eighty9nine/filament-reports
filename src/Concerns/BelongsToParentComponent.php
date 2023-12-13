<?php

namespace EightyNine\Reports\Concerns;

use EightyNine\Reports\Components\Component;

trait BelongsToParentComponent
{
    protected ?Component $parentComponent = null;

    public function parentComponent(Component $component): static
    {
        $this->parentComponent = $component;

        return $this;
    }

    public function getParentComponent(): ?Component
    {
        return $this->parentComponent;
    }
}
