<?php

/**
 * Base test report class
 */
class TestReport
{
    public ?string $heading = 'Test Report';

    public ?string $group = null;

    protected array $panels = [];

    public function getPanels(): array
    {
        return $this->panels;
    }
}
