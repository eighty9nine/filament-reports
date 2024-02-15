<?php

namespace EightyNine\Reports\Components\Footer\Layout;

use EightyNine\Reports\Components\Component;
use EightyNine\Reports\Components\Concerns\CanBeAligned;

class FooterRow extends Component
{
    use CanBeAligned;

    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.footer.layout.footer-row';

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
