<?php

namespace EightyNine\Reports\Components;

class Image extends Component
{
    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.image';

    public function __construct(public ?string $path = null)
    {
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public static function make(?string $path): static
    {
        $static = app(static::class, ['path' => $path]);

        return $static;
    }

}
