<?php

namespace EightyNine\Reports\Components\Concerns;

use EightyNine\Reports\Enums\ImageWidth;

trait CanModifyImageWidth
{
    protected ImageWidth $imageWidth = ImageWidth::Base;

    public function width(ImageWidth $imageWidth): static
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    public function getWidth(): ImageWidth
    {
        return $this->imageWidth;
    }

    public function widthTiny(): static
    {
        $this->imageWidth = ImageWidth::Tiny;

        return $this;
    }

    public function widthXs(): static
    {
        $this->imageWidth = ImageWidth::Xs;

        return $this;
    }

    public function widthSm(): static
    {
        $this->imageWidth = ImageWidth::Sm;

        return $this;
    }

    public function widthBase(): static
    {
        $this->imageWidth = ImageWidth::Base;

        return $this;
    }

    public function widthLg(): static
    {
        $this->imageWidth = ImageWidth::Lg;

        return $this;
    }

    public function widthXl(): static
    {
        $this->imageWidth = ImageWidth::Xl;

        return $this;
    }

    public function width2Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl2;

        return $this;
    }

    public function width3Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl3;

        return $this;
    }

    public function width4Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl4;

        return $this;
    }

    public function width5Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl5;

        return $this;
    }

    public function width6Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl6;

        return $this;
    }

    public function width7Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl7;

        return $this;
    }

    public function width8Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl8;

        return $this;
    }

    public function width9Xl(): static
    {
        $this->imageWidth = ImageWidth::Xl9;

        return $this;
    }
}
