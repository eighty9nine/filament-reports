<?php

namespace EightyNine\Reports\Components\Body\Layout;

use EightyNine\Reports\Components\Component;
use EightyNine\Reports\Components\Concerns\CanBeAligned;

class BodyRow extends Component
{
    use CanBeAligned;

    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.body.layout.body-row';

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
