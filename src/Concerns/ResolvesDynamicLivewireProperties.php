<?php

namespace EightyNine\Reports\Concerns;

use EightyNine\Reports\Contracts\HasActionsPanel;
use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;
use Filament\Forms\Contracts\HasForms;
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
        // dd($property, $this instanceof HasFooter );
        return match ($property) {
            'header', $this instanceof HasHeader => $this->getTableHeader(),
            'body', $this instanceof HasBody => $this->getTableBody(),
            'footer', $this instanceof HasFooter => $this->getTableFooter(),
            'actionsPanel', $this instanceof HasActionsPanel => $this->getActionsPanel(),
            'filterForm', $this instanceof HasForms => $this->getFilterForm(),
            default => throw new PropertyNotFoundException($property, get_class($this)),
        };
    }
}
