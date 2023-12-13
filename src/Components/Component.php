<?php

namespace EightyNine\Reports\Components;

use Filament\Support\Components\ViewComponent;
use Illuminate\Database\Eloquent\Model;

class Component extends ViewComponent
{
    use Concerns\BelongsToContainer;
    use Concerns\HasChildComponents;
    use Concerns\CanBeHidden;

    protected string $evaluationIdentifier = 'component';

    /**
     * @return array<mixed>
     */
    protected function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'context', 'operation' => [$this->getContainer()->getOperation()],
            'get' => [$this->getGetCallback()],
            'livewire' => [$this->getLivewire()],
            'model' => [$this->getModel()],
            'record' => [$this->getRecord()],
            'set' => [$this->getSetCallback()],
            'state' => [$this->getState()],
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
