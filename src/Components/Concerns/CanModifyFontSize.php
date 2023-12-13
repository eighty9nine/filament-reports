<?php

namespace EightyNine\Reports\Components\Concerns;

use EightyNine\Reports\Enums\FontSize;

trait CanModifyFontSize
{

    protected FontSize $fontSize = FontSize::Base;

    public function fontSize(FontSize $fontSize): static
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    public function getFontSize(): FontSize
    {
        return $this->fontSize;
    }

    public function fontXs(): static
    {
        $this->fontSize = FontSize::Xs;

        return $this;
    }

    public function fontSm(): static
    {
        $this->fontSize = FontSize::Sm;

        return $this;
    }

    public function fontBase(): static
    {
        $this->fontSize = FontSize::Base;

        return $this;
    }

    public function fontLg(): static
    {
        $this->fontSize = FontSize::Lg;

        return $this;
    }

    public function fontXl(): static
    {
        $this->fontSize = FontSize::Xl;

        return $this;
    }

    public function font2Xl(): static
    {
        $this->fontSize = FontSize::Xl2;

        return $this;
    }

    public function font3Xl(): static
    {
        $this->fontSize = FontSize::Xl3;

        return $this;
    }

    public function font4Xl(): static
    {
        $this->fontSize = FontSize::Xl4;

        return $this;
    }

    public function font5Xl(): static
    {
        $this->fontSize = FontSize::Xl5;

        return $this;
    }

    public function font6Xl(): static
    {
        $this->fontSize = FontSize::Xl6;

        return $this;
    }

    public function font7Xl(): static
    {
        $this->fontSize = FontSize::Xl7;

        return $this;
    }

    public function font8Xl(): static
    {
        $this->fontSize = FontSize::Xl8;

        return $this;
    }

    public function font9Xl(): static
    {
        $this->fontSize = FontSize::Xl9;

        return $this;
    }
}
