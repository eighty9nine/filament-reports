<?php

namespace EightyNine\Reports\Concerns;

use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Schemas\Schema;

trait HasFilterForm
{
    use InteractsWithFormActions;
    use InteractsWithForms;

    public ?array $data = [];

    protected ?array $filterData = [];

    public function mount(): void
    {
        $this->filterForm->fill();
    }

    public function filterForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function filter(): void
    {
        reports()->setFilterState($this->filterForm->getState());
    }

    protected function getFilterData(): array
    {
        return $this->filterData;
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('filter')
                ->label(__('filament-reports::reports.filter-button-label'))
                ->icon('heroicon-o-funnel')
                ->submit('filter')
                ->keyBindings(['mod+s']),
        ];
    }
}
