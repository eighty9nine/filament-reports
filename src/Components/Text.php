<?php

namespace EightyNine\Reports\Components;

class Text extends Component
{
    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.text';

    public function __construct(public ?string $text = null)
    {
    }


    public function getText(): ?string
    {
        return $this->text;
    }

    public static function make(?string $text): static
    {
        $static = app(static::class, ['text' => $text]);

        return $static;
    }
}
