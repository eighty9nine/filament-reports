<?php

namespace EightyNine\Reports\Concerns;

use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;

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

    public function filterForm(Form $form): Form
    {
        return $form;
    }

    protected function getFilterForm(): Form
    {
        return $this->filterForm(Form::make($this))
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
                ->label('Filter')
                ->submit('filter')
                ->keyBindings(['mod+s']),
        ];
    }
}
