<?php

namespace EightyNine\Reports;

use EightyNine\Reports\Concerns\HasFilterForm;
use EightyNine\Reports\Concerns\HasReportActions;
use EightyNine\Reports\Concerns\InteractsWithActionsPanel;
use EightyNine\Reports\Concerns\ResolvesDynamicLivewireProperties;
use EightyNine\Reports\Contracts\HasActionsPanel;
use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;
use Filament\Facades\Filament;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Schema;

class Report extends Page implements HasActionsPanel, HasBody, HasFooter, HasForms, HasHeader
{
    use HasFilterForm;
    use HasReportActions;
    use InteractsWithActionsPanel;
    use ResolvesDynamicLivewireProperties {
        ResolvesDynamicLivewireProperties::__get insteadof HasFilterForm;
    }

    public ?string $heading = '';

    public ?array $sections = ['pad', 'header', 'body', 'footer', 'pad'];

    public ?string $subHeading = '';

    public ?string $icon = 'heroicon-o-document-text';

    public string $view = 'filament-reports::pages.report';

    public ?string $group = null;

    public ?string $logo = '/img/logo.png';

    public bool $shouldOpenInNewTab = true;

    public int $sort = 0;

    protected array $panels = [];

    public function getSort(): int
    {
        return $this->sort;
    }

    public function getShouldOpenInNewTab(): bool
    {
        return $this->shouldOpenInNewTab;
    }

    public function getHeading(): string
    {
        return $this->heading;
    }

    public function getSubHeading(): string
    {
        return $this->subHeading;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getGroup(): ?string
    {
        return $this->group ?? __('filament-reports::menu-page.nav.group');
    }

    public static function getRouteName(?Panel $panel = null): string
    {
        $panel ??= Filament::getCurrentPanel();

        return (string) str(static::getSlug())
            ->replace('/', '.')
            ->prepend("filament.{$panel->getId()}.reports.");
    }

    public function getTableHeader(): Schema
    {
        return $this->header(Schema::make());
    }

    public function getTableBody(): Schema
    {
        return $this->body(Schema::make());
    }

    public function getTableFooter(): Schema
    {
        return $this->footer(Schema::make());
    }

    /**
     * Define the header content for the report.
     * Override this method to add header components.
     */
    public function header(Schema $schema): Schema
    {
        return $schema->components([
            // Override this method to add header components
        ]);
    }

    /**
     * Define the body content for the report.
     * Override this method to add body components.
     */
    public function body(Schema $schema): Schema
    {
        return $schema->components([
            // Override this method to add body components
        ]);
    }

    /**
     * Define the footer content for the report.
     * Override this method to add footer components.
     */
    public function footer(Schema $schema): Schema
    {
        return $schema->components([
            // Override this method to add footer components
        ]);
    }

    /**
     * Set which panels this report should be shown in
     */
    public function panels(array $panels): static
    {
        $this->panels = $panels;

        return $this;
    }

    /**
     * Get the panels this report should be shown in
     */
    public function getPanels(): array
    {
        return $this->panels;
    }
}
