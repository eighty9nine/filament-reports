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

    public static function getNavigationLabel(): string
    {
        return ReportsManager::getInstance()->getNavigationLabel();
    }

    public function getTitle(): string
    {
        return ReportsManager::getInstance()->getTitle();
    }


    public static function getSlug(): string
    {
        return ReportsManager::getInstance()->getSlug() ?? static::getSlug();
    }

    public function getHeading(): string
    {
        return ReportsManager::getInstance()->getHeading();
    }

    public function getSubheading(): ?string
    {
        return ReportsManager::getInstance()->getSubheading();
    }

    public function getHeader(): ?View
    {
        return ReportsManager::getInstance()->getHeader();
    }

    public function getFooter(): ?View
    {
        return ReportsManager::getInstance()->getFooter();
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return ReportsManager::getInstance()->getMaxContentWidth();
    }

    protected function getHeaderActions(): array
    {
        return ReportsManager::getInstance()->getHeaderActions();
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return ReportsManager::getInstance()->getHeaderWidgetsColumns();
    }

    protected function getHeaderWidgets(): array
    {
        return ReportsManager::getInstance()->getHeaderWidgets();
    }

    public static function getActiveNavigationIcon(): ?string
    {
        return ReportsManager::getInstance()->getActiveNavigationIcon() ??
            static::$activeNavigationIcon ??
            static::getNavigationIcon();
    }

    public static function getNavigationIcon(): ?string
    {
        return ReportsManager::getInstance()->getNavigationIcon() ??
            static::$navigationIcon;
    }

    public static function getNavigationBadge(): ?string
    {
        return ReportsManager::getInstance()->getNavigationBadge();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return ReportsManager::getInstance()->getNavigationBadgeColor();
    }

    public static function getNavigationSort(): ?int
    {
        return ReportsManager::getInstance()->getNavigationSort() ??
            static::$navigationSort;
    }

    public static function getNavigationGroup(): ?string
    {
        return ReportsManager::getInstance()->getNavigationGroup() ??
            static::$navigationGroup;
    }

    public static function getNavigationParentItem(): ?string
    {
        return ReportsManager::getInstance()->getNavigationParentItem() ??
            static::$navigationParentItem;
    }

    public function getReports()
    {
        $reports = ReportsManager::getInstance()->getReports();

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
