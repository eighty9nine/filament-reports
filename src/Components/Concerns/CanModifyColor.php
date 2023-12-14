<?php

namespace EightyNine\Reports\Components\Concerns;

use Filament\Support\Concerns\HasColor;

trait CanModifyColor
{
    use HasColor;

    public function color(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function primary(): static
    {
        $this->color = 'primary';

        return $this;
    }

    public function secondary(): static
    {
        $this->color = 'secondary';

        return $this;
    }

    public function success(): static
    {
        $this->color = 'success';

        return $this;
    }

    public function danger(): static
    {
        $this->color = 'danger';

        return $this;
    }

    public function warning(): static
    {
        $this->color = 'warning';

        return $this;
    }

    public function info(): static
    {
        $this->color = 'info';

        return $this;
    }
}
