<?php

namespace EightyNine\Reports;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Enums\MaxWidth;

class ReportsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-reports';
    }

    public function register(Panel $panel): void
    {
        $panel->discoverPages(
            in: __DIR__ . "/Pages",
            for: "EightyNine\\Reports\\Pages"
        );

        // register reports
        ReportsManager::getInstance()->discoverReports(
            in: app_path('Filament/Reports'),
            for: 'App\\Filament\\Reports'
        );
    }


    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function navigationLabel(string $label)
    {
        ReportsManager::getInstance()->navigationLabel($label);
        return $this;
    }

    public function title(string $title)
    {
        ReportsManager::getInstance()->title($title);
        return $this;
    }

    public function heading(string $heading)
    {
        ReportsManager::getInstance()->heading($heading);
        return $this;
    }

    public function slug(string $slug)
    {
        ReportsManager::getInstance()->slug($slug);
        return $this;
    }

    public function subHeading(string $subHeading)
    {
        ReportsManager::getInstance()->subHeading($subHeading);
        return $this;
    }

    public function header(string $header)
    {
        ReportsManager::getInstance()->header($header);
        return $this;
    }

    public function footer(string $footer)
    {
        ReportsManager::getInstance()->footer($footer);
        return $this;
    }

    public function maxContentWidth(MaxWidth $maxContentWidth)
    {
        ReportsManager::getInstance()->maxContentWidth($maxContentWidth);
        return $this;
    }

    public function headerActtions(array $headerActions)
    {
        ReportsManager::getInstance()->headerActtions($headerActions);
        return $this;
    }

    public function headerWidgets(array $headerWidgets)
    {
        ReportsManager::getInstance()->headerWidgets($headerWidgets);
        return $this;
    }

    public function headerWidgetsColumns(int|array $headerWidgetsColumns)
    {
        ReportsManager::getInstance()->headerWidgetsColumns($headerWidgetsColumns);
        return $this;
    }

    public function navigationIcon(string $navigationIcon)
    {
        ReportsManager::getInstance()->navigationIcon($navigationIcon);
        return $this;
    }

    public function activeNavigationIcon(string $activeNavigationIcon)
    {
        ReportsManager::getInstance()->activeNavigationIcon($activeNavigationIcon);
        return $this;
    }

    public function navigationSort(int $navigationSort)
    {
        ReportsManager::getInstance()->navigationSort($navigationSort);
        return $this;
    }

    public function navigationGroup(string $navigationGroup)
    {
        ReportsManager::getInstance()->navigationGroup($navigationGroup);
        return $this;
    }

    public function navigationParentItem(string $navigationParentItem)
    {
        ReportsManager::getInstance()->navigationParentItem($navigationParentItem);
        return $this;
    }

    public function navigationBadge(string $navigationBadge)
    {
        ReportsManager::getInstance()->navigationBadge($navigationBadge);
        return $this;
    }

    public function navigationBadgeColor(string|array|null $navigationBadgeColor)
    {
        ReportsManager::getInstance()->navigationBadgeColor($navigationBadgeColor);
        return $this;
    }
}
