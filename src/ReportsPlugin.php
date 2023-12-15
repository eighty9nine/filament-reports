<?php

namespace EightyNine\Reports;

use Filament\Contracts\Plugin;
use Filament\Navigation\NavigationItem;
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

        // register reports
        reports()->discoverReports(
            in: config("filament-reports.reports_directory"),
            for: config("filament-reports.reports_namespace")
        );

        $panel->discoverPages(
            in: __DIR__ . "/Pages",
            for: "EightyNine\\Reports\\Pages"
        );
    }


    public function boot(Panel $panel): void
    {

        if (!reports()->getUseReportListPage()) {
            $panel->navigationItems(collect(reports()->getReports())->map(function ($report) {
                $report = app($report);
                return NavigationItem::make($report->getTitle())
                    ->url($report->getUrl())
                    ->group(reports()->getNavigationGroup() ?? __("filament-reports::menu-page.nav.group"));
            })->toArray());
        }
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
        reports()->navigationLabel($label);
        return $this;
    }

    public function title(string $title)
    {
        reports()->title($title);
        return $this;
    }

    public function heading(string $heading)
    {
        reports()->heading($heading);
        return $this;
    }

    public function slug(string $slug)
    {
        reports()->slug($slug);
        return $this;
    }

    public function subHeading(string $subHeading)
    {
        reports()->subHeading($subHeading);
        return $this;
    }

    public function header(string $header)
    {
        reports()->header($header);
        return $this;
    }

    public function footer(string $footer)
    {
        reports()->footer($footer);
        return $this;
    }

    public function maxContentWidth(MaxWidth $maxContentWidth)
    {
        reports()->maxContentWidth($maxContentWidth);
        return $this;
    }

    public function headerActtions(array $headerActions)
    {
        reports()->headerActtions($headerActions);
        return $this;
    }

    public function headerWidgets(array $headerWidgets)
    {
        reports()->headerWidgets($headerWidgets);
        return $this;
    }

    public function headerWidgetsColumns(int|array $headerWidgetsColumns)
    {
        reports()->headerWidgetsColumns($headerWidgetsColumns);
        return $this;
    }

    public function navigationIcon(string $navigationIcon)
    {
        reports()->navigationIcon($navigationIcon);
        return $this;
    }

    public function activeNavigationIcon(string $activeNavigationIcon)
    {
        reports()->activeNavigationIcon($activeNavigationIcon);
        return $this;
    }

    public function navigationSort(int $navigationSort)
    {
        reports()->navigationSort($navigationSort);
        return $this;
    }

    public function navigationGroup(string $navigationGroup)
    {
        reports()->navigationGroup($navigationGroup);
        return $this;
    }

    public function navigationParentItem(string $navigationParentItem)
    {
        reports()->navigationParentItem($navigationParentItem);
        return $this;
    }

    public function navigationBadge(string $navigationBadge)
    {
        reports()->navigationBadge($navigationBadge);
        return $this;
    }

    public function navigationBadgeColor(string|array|null $navigationBadgeColor)
    {
        reports()->navigationBadgeColor($navigationBadgeColor);
        return $this;
    }

    public function useReportListPage(bool $useReportListPage = true)
    {
        reports()->useReportListPage($useReportListPage);
        return $this;
    }
}
