<?php

namespace EightyNine\Reports\Components;

use EightyNine\Reports\Components\Concerns\CanModifyImageWidth;

class Image extends Component
{
    use CanModifyImageWidth;

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
