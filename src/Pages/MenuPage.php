<?php

namespace EightyNine\Reports\Pages;

use EightyNine\Reports\ReportsManager;
use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\View\View;

class MenuPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-reports::pages.menu-page';


    public static function shouldRegisterNavigation(): bool
    {
        return reports()->getUseReportListPage();
    }

    public static function getNavigationLabel(): string
    {
        return reports()->getNavigationLabel();
    }

    public function getTitle(): string
    {
        return reports()->getTitle();
    }


    public static function getSlug(): string
    {
        return reports()->getSlug() ?? static::getSlug();
    }

    public function getHeading(): string
    {
        return reports()->getHeading();
    }

    public function getSubheading(): ?string
    {
        return reports()->getSubheading();
    }

    public function getHeader(): ?View
    {
        return reports()->getHeader();
    }

    public function getFooter(): ?View
    {
        return reports()->getFooter();
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return reports()->getMaxContentWidth();
    }

    protected function getHeaderActions(): array
    {
        return reports()->getHeaderActions();
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return reports()->getHeaderWidgetsColumns();
    }

    protected function getHeaderWidgets(): array
    {
        return reports()->getHeaderWidgets();
    }

    public static function getActiveNavigationIcon(): ?string
    {
        return reports()->getActiveNavigationIcon() ??
            static::$activeNavigationIcon ??
            static::getNavigationIcon();
    }

    public static function getNavigationIcon(): ?string
    {
        return reports()->getNavigationIcon() ??
            static::$navigationIcon;
    }

    public static function getNavigationBadge(): ?string
    {
        return reports()->getNavigationBadge();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return reports()->getNavigationBadgeColor();
    }

    public static function getNavigationSort(): ?int
    {
        return reports()->getNavigationSort() ??
            static::$navigationSort;
    }

    public static function getNavigationGroup(): ?string
    {
        return reports()->getNavigationGroup() ??
            static::$navigationGroup;
    }

    public static function getNavigationParentItem(): ?string
    {
        return reports()->getNavigationParentItem() ??
            static::$navigationParentItem;
    }

    public function getReports()
    {
        $reports = reports()->getReports();

        return $reports;
    }

    // public function mount()
    // {
    //     $reports = $this->getReports();
    //     foreach ($reports as $key => $report) {
    //         $report = app($report);
    //         dd($report);
    //     }
    // }
}
