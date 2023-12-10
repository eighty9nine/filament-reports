<?php

namespace EightyNine\Reports\Concerns;

use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\View\View;

trait HasPageSettings
{

    protected ?string $navigationLabel = null;

    protected ?string $title = null;

    protected ?string $slug = null;

    protected ?string $heading = null;

    protected ?string $subheading = null;

    protected ?string $header = null;

    protected ?string $footer = null;

    protected ?MaxWidth $maxContentWidth = null;

    protected array $headerActions = [];

    protected array $headerWidgets = [];

    protected int | array $headerWidgetsColumns = [];

    protected ?string $navigationIcon = null;

    protected ?string $activeNavigationIcon = null;

    protected ?int $navigationSort = null;

    protected ?string $navigationGroup = null;

    protected ?string $navigationParentItem = null;

    protected string | array | null $navigationBadgeColor = null;

    protected ?string $navigationBadge = null;

    public function navigationLabel(string $label)
    {
        $this->navigationLabel = $label;
        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function heading(string $heading)
    {
        $this->heading = $heading;
        return $this;
    }

    public function slug(string $slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function subHeading(string $subheading)
    {
        $this->subheading = $subheading;
        return $this;
    }

    public function header(string $header)
    {
        $this->header = $header;
        return $this;
    }

    public function footer(string $footer)
    {
        $this->footer = $footer;
        return $this;
    }

    public function maxContentWidth(MaxWidth $maxContentWidth)
    {
        $this->maxContentWidth = $maxContentWidth;
        return $this;
    }

    public function headerActtions(array $headerActions)
    {
        $this->headerActions = $headerActions;
        return $this;
    }

    public function headerWidgets(array $headerWidgets)
    {
        $this->headerWidgets = $headerWidgets;
        return $this;
    }

    public function headerWidgetsColumns(int|array $headerWidgetsColumns)
    {
        $this->headerWidgetsColumns = $headerWidgetsColumns;
        return $this;
    }

    public function navigationIcon(string $navigationIcon)
    {
        $this->navigationIcon = $navigationIcon;
        return $this;
    }

    public function activeNavigationIcon(string $activeNavigationIcon)
    {
        $this->activeNavigationIcon = $activeNavigationIcon;
        return $this;
    }

    public function navigationSort(int $navigationSort)
    {
        $this->navigationSort = $navigationSort;
        return $this;
    }

    public function navigationGroup(string $navigationGroup)
    {
        $this->navigationGroup = $navigationGroup;
        return $this;
    }

    public function navigationParentItem(string $navigationParentItem)
    {
        $this->navigationParentItem = $navigationParentItem;
        return $this;
    }

    public function navigationBadge(string $navigationBadge)
    {
        $this->navigationBadge = $navigationBadge;
        return $this;
    }

    public function navigationBadgeColor(string|array|null $navigationBadgeColor)
    {
        $this->navigationBadgeColor = $navigationBadgeColor;
        return $this;
    }

    public function getHeaderWidgetsColumns(): array
    {
        return $this->headerWidgetsColumns;
    }

    public function getHeaderWidgets(): array
    {
        return $this->headerWidgets;
    }

    public function getHeaderActions(): array
    {
        return $this->headerActions;
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return $this->maxContentWidth ?? MaxWidth::Full;
    }

    public function getFooter(): ?View
    {
        return $this->footer ? view($this->footer) : null;
    }

    public function getHeader(): ?View
    {
        return $this->header ? view($this->header) : null;
    }

    public function getSubheading(): ?string
    {
        return $this->subheading;
    }

    public function getHeading(): string
    {
        return $this->heading ?? __("Reports");
    }

    public function getNavigationLabel(): string
    {
        return $this->navigationLabel ?? __("Reports");
    }

    public function getTitle(): string
    {
        return $this->title ?? __("Reports");
    }

    public function getSlug(): string
    {
        return $this->slug ?? "reports";
    }

    public function getActiveNavigationIcon(): ?string
    {
        return $this->activeNavigationIcon;
    }

    public function getNavigationIcon(): ?string
    {
        return $this->navigationIcon;
    }

    public function getNavigationBadge(): ?string
    {
        return $this->navigationBadge;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->navigationGroup;
    }

    public function getNavigationParentItem(): ?string
    {
        return $this->navigationParentItem;
    }

    public function getNavigationBadgeColor(): string | array | null
    {
        return $this->navigationBadgeColor;
    }

    public function getNavigationSort(): ?int
    {
        return $this->navigationSort;
    }

    public function getReports()
    {
        return $this->reports;
    }

}
