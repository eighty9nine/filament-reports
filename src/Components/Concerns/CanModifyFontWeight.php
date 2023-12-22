<?php

namespace EightyNine\Reports\Components\Concerns;

use EightyNine\Reports\Enums\FontWeight;

trait CanModifyFontWeight
{
    protected FontWeight $fontWeight = FontWeight::Normal;

    public function fontWeight(FontWeight $fontWeight): static
    {
        $this->fontWeight = $fontWeight;

        return $this;
    }

    public function getFontWeight(): FontWeight
    {
        return $this->fontWeight;
    }

    public function fontThin(): static
    {
        $this->fontWeight = FontWeight::Thin;

        return $this;
    }

    public function fontExtraLight(): static
    {
        $this->fontWeight = FontWeight::ExtraLight;

        return $this;
    }

    public function fontLight(): static
    {
        $this->fontWeight = FontWeight::Light;

        return $this;
    }

    public function fontNormal(): static
    {
        $this->fontWeight = FontWeight::Normal;

        return $this;
    }

    public function fontMedium(): static
    {
        $this->fontWeight = FontWeight::Medium;

        return $this;
    }

    public function fontSemiBold(): static
    {
        $this->fontWeight = FontWeight::SemiBold;

        return $this;
    }

    public function fontBold(): static
    {
        $this->fontWeight = FontWeight::Bold;

        return $this;
    }

    public function fontExtraBold(): static
    {
        $this->fontWeight = FontWeight::ExtraBold;

        return $this;
    }

    public function fontSuperBold(): static
    {
        $this->fontWeight = FontWeight::SuperBold;

        return $this;
    }
}
