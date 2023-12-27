<?php

namespace EightyNine\Reports\Components;

use EightyNine\Reports\Components\Body\view;

class VerticalSpace extends Component
{
    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.vertical-space';

    protected ?string $size = '20px';

    public static function make(?string $size = null): static
    {
        $static = app(static::class);
        if ($size) {
            $static->size($size);
        }

        return $static;
    }

    public function size(?string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }
}
