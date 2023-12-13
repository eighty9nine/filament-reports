<?php

namespace EightyNine\Reports\Components\Footer\Layout;

use EightyNine\Reports\Components\Component;

class FooterRow extends Component
{
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
