<?php

namespace EightyNine\Reports\Components\Header\Layout;

use EightyNine\Reports\Components\Component;
use EightyNine\Reports\Components\Concerns\CanBeAligned;

class HeaderRow extends Component
{
    use CanBeAligned;

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
