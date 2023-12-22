<?php

namespace EightyNine\Reports\Components\Header\Layout;

use EightyNine\Reports\Components\Component;
use EightyNine\Reports\Components\Concerns\CanBeAligned;

class HeaderColumn extends Component
{
    use CanBeAligned;

    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.header.layout.header-column';

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
