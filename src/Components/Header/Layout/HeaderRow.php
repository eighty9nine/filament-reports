<?php

namespace EightyNine\Reports\Components\Header\Layout;

use EightyNine\Reports\Components\Component;

class HeaderRow extends Component
{
    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.header.layout.header-row';

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
