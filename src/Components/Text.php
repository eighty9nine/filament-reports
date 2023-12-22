<?php

namespace EightyNine\Reports\Components;

use EightyNine\Reports\Components\Concerns\CanModifyColor;
use EightyNine\Reports\Components\Concerns\CanModifyFontSize;
use EightyNine\Reports\Components\Concerns\CanModifyFontWeight;

class Text extends Component
{
    use CanModifyColor;
    use CanModifyFontSize;
    use CanModifyFontWeight;

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

    public function title(): static
    {
        $this->font3Xl();
        $this->fontExtraBold();

        return $this;
    }

    public function subTitle(): static
    {
        $this->fontSm();
        $this->fontLight();

        return $this;
    }
}
