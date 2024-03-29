<?php

namespace EightyNine\Reports\Components\Concerns;

use Closure;
use EightyNine\Reports\ComponentContainer;
use EightyNine\Reports\Components\Component;

trait HasChildComponents
{
    /**
     * @var array<Component> | Closure
     */
    protected array|Closure $childComponents = [];

    /**
     * @param  array<Component> | Closure  $components
     */
    public function childComponents(array|Closure $components): static
    {
        $this->childComponents = $components;

        return $this;
    }

    /**
     * @param  array<Component> | Closure  $components
     */
    public function schema(array|Closure $components): static
    {
        $this->childComponents($components);

        return $this;
    }

    /**
     * @return array<Component>
     */
    public function getChildComponents(): array
    {
        return $this->evaluate($this->childComponents);
    }

    /**
     * @param  array-key  $key
     */
    public function getChildComponentContainer($key = null): ComponentContainer
    {
        if (filled($key) && array_key_exists($key, $containers = $this->getChildComponentContainers())) {
            return $containers[$key];
        }

        return ComponentContainer::make($this->getLivewire())
            ->parentComponent($this)
            ->components($this->getChildComponents());
    }

    /**
     * @return array<ComponentContainer>
     */
    public function getChildComponentContainers(bool $withHidden = false): array
    {
        if (! $this->hasChildComponentContainer($withHidden)) {
            return [];
        }

        return [$this->getChildComponentContainer()];
    }

    public function hasChildComponentContainer(bool $withHidden = false): bool
    {
        if ((! $withHidden) && $this->isHidden()) {
            return false;
        }

        if ($this->getChildComponents() === []) {
            return false;
        }

        return true;
    }
}
