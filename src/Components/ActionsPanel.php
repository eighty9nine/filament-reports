<?php

namespace EightyNine\Reports\Components;

class ActionsPanel extends Component
{

    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.actions-panel';

    public function __construct() {
    }

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }

}
