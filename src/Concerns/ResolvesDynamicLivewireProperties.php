<?php

namespace EightyNine\Reports\Concerns;

use EightyNine\Reports\Contracts\HasActionsPanel;
use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;
use Livewire\Exceptions\PropertyNotFoundException;

trait ResolvesDynamicLivewireProperties
{
    /**
     * @param  string  $property
     *
     * @throws PropertyNotFoundException
     */
    public function __get($property): mixed
    {
        // Try parent implementation first (Filament's schema resolution)
        try {
            return parent::__get($property);
        } catch (PropertyNotFoundException $exception) {
            // If parent doesn't handle it, check our custom properties
        }

        return match ($property) {
            'header' => $this instanceof HasHeader ? $this->getTableHeader() : throw $exception,
            'body' => $this instanceof HasBody ? $this->getTableBody() : throw $exception,
            'footer' => $this instanceof HasFooter ? $this->getTableFooter() : throw $exception,
            'actionsPanel' => $this instanceof HasActionsPanel ? $this->getActionsPanel() : throw $exception,
            default => throw $exception,
        };
    }
}
