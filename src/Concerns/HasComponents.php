<?php

namespace EightyNine\Reports\Concerns;

use Closure;
use EightyNine\Reports\Components\Component;

trait HasComponents
{
    /**
     * @var array<Component> | Closure
     */
    protected array|Closure $components = [];

    /**
     * @param  array<Component> | Closure  $components
     */
    public function components(array|Closure $components): static
    {
        $this->components = $components;

        return $this;
    }

    /**
     * @param  array<Component> | Closure  $components
     */
    public function schema(array|Closure $components): static
    {
        $this->components($components);

        return $this;
    }

    public function getComponent(string|Closure $findComponentUsing, bool $withHidden = false): ?Component
    {
        if (is_string($findComponentUsing)) {
            $findComponentUsing = static function (Component $component) use ($findComponentUsing): bool {
                $key = $component->getKey();

                if ($key === null) {
                    return false;
                }

                return $key === $findComponentUsing;
            };
        }

        return collect($this->getFlatComponents($withHidden))->first($findComponentUsing);
    }

    /**
     * @return array<Component>
     */
    public function getFlatComponents(bool $withHidden = false): array
    {
        return array_reduce(
            $this->getComponents($withHidden),
            function (array $carry, Component $component) use ($withHidden): array {
                $carry[] = $component;

                foreach ($component->getChildComponentContainers($withHidden) as $childComponentContainer) {
                    $carry = [
                        ...$carry,
                        ...$childComponentContainer->getFlatComponents($withHidden),
                    ];
                }

                return $carry;
            },
            initial: [],
        );
    }

    /**
     * @return array<Component>
     */
    public function getComponents(bool $withHidden = false): array
    {

        $components = array_map(function (Component $component): Component {
            $component->container($this);

            return $component;
        }, $this->evaluate($this->components));

        if ($withHidden) {
            return $components;
        }

        return array_filter(
            $components,
            fn (Component $component) => $component->isVisible(),
        );
    }
}
