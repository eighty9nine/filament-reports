<?php

namespace EightyNine\Reports;

use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;
use Filament\Support\Components\ViewComponent;
use Filament\Support\Concerns\HasExtraAttributes;
use Illuminate\Database\Eloquent\Model;

class ComponentContainer extends ViewComponent
{
    use Concerns\BelongsToLivewire;
    use Concerns\BelongsToParentComponent;
    use Concerns\HasComponents;
    use HasExtraAttributes;

    protected string $view = 'filament-reports::component-container';

    protected string $evaluationIdentifier = 'container';

    protected string $viewIdentifier = 'container';

    final public function __construct(HasHeader|HasBody|HasFooter $livewire)
    {
        $this->livewire($livewire);
    }

    public static function make(HasHeader|HasBody|HasFooter $livewire): static
    {
        $static = app(static::class, ['livewire' => $livewire]);
        $static->configure();

        return $static;
    }

    /**
     * @return array<mixed>
     */
    protected function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'livewire' => [$this->getLivewire()],
            'model' => [$this->getModel()],
            'record' => [$this->getRecord()],
            'filters' => [$this->getFilters()],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }

    /**
     * @return array<mixed>
     */
    protected function resolveDefaultClosureDependencyForEvaluationByType(string $parameterType): array
    {
        $record = $this->getRecord();

        if (! $record) {
            return parent::resolveDefaultClosureDependencyForEvaluationByType($parameterType);
        }

        return match ($parameterType) {
            Model::class, $record::class => [$record],
            default => parent::resolveDefaultClosureDependencyForEvaluationByType($parameterType),
        };
    }
}
