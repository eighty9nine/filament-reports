<?php

namespace EightyNine\Reports\Components\Body;

use EightyNine\Reports\Components\Component;

class TableGroup extends Component
{
    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.body.table-group';

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
