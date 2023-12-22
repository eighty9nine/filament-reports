<?php

namespace EightyNine\Reports\Components\Concerns;

use EightyNine\Reports\Enums\HorizontalAlignment;
use EightyNine\Reports\Enums\VerticalAlignment;

trait CanBeAligned
{
    protected VerticalAlignment $verticalAlignment = VerticalAlignment::Top;

    protected HorizontalAlignment $horizontalAlignment = HorizontalAlignment::Left;

    public function getVerticalAlignment(): VerticalAlignment
    {
        return $this->verticalAlignment;
    }

    public function getHorizontalAlignment(): HorizontalAlignment
    {
        return $this->horizontalAlignment;
    }

    public function alignTop()
    {
        $this->verticalAlignment = VerticalAlignment::Top;

        return $this;
    }

    public function alignBottom()
    {
        $this->verticalAlignment = VerticalAlignment::Bottom;

        return $this;
    }

    public function alignMiddle()
    {
        $this->verticalAlignment = VerticalAlignment::Middle;

        return $this;
    }

    public function alignRight()
    {
        $this->horizontalAlignment = HorizontalAlignment::Right;

        return $this;
    }

    public function alignLeft()
    {
        $this->horizontalAlignment = HorizontalAlignment::Left;

        return $this;
    }

    public function alignCenter()
    {
        $this->horizontalAlignment = HorizontalAlignment::Center;

        return $this;
    }
}
