# Panel-Specific Report Filtering - Usage Examples

This document demonstrates how to use the implemented panel-specific filtering functionality in the filament-reports plugin.

## Overview

The plugin now supports multiple ways to filter reports for specific panels in a multi-panel Filament application:

1. **Plugin-level filtering** - Configure which reports show in each panel
2. **Report-level panel configuration** - Configure in the report class which panels it should appear in
3. **Panel-specific directories** - Use different directories for different panels

## 1. Plugin-Level Filtering

### Method 1: Allow Only Specific Reports

```php
// In your AdminPanelProvider.php
use EightyNine\Reports\ReportsPlugin;
use App\Filament\Reports\UserReport;
use App\Filament\Reports\OrderReport;

public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->path('admin')
        ->plugins([
            ReportsPlugin::make()
                ->reports([
                    UserReport::class,
                    OrderReport::class,
                ])
        ]);
}
```

### Method 2: Exclude Specific Reports

```php
// In your CustomerPanelProvider.php
use EightyNine\Reports\ReportsPlugin;
use App\Filament\Reports\AdminReport;
use App\Filament\Reports\SystemReport;

public function panel(Panel $panel): Panel
{
    return $panel
        ->id('customer')
        ->path('customer')
        ->plugins([
            ReportsPlugin::make()
                ->excludeReports([
                    AdminReport::class,
                    SystemReport::class,
                ])
        ]);
}
```

### Method 3: Custom Filter Logic

```php
// In your PanelProvider.php
use EightyNine\Reports\ReportsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->id('manager')
        ->path('manager')
        ->plugins([
            ReportsPlugin::make()
                ->filterReports(function (string $reportClass, Panel $panel) {
                    // Custom logic to determine if report should be shown
                    $report = app($reportClass);
                    
                    // Only show reports with specific groups
                    return in_array($report->group, ['sales', 'finance']);
                })
        ]);
}
```

## 2. Report-Level Panel Configuration

Configure in your report class which panels it should appear in:

```php
<?php

namespace App\Filament\Reports;

use EightyNine\Reports\Report;

class SalesReport extends Report
{
    public ?string $heading = "Sales Report";
    
    // This report will only appear in admin and manager panels
    protected array $panels = ['admin', 'manager'];
    
    // Or use the method approach
    public function panels(): array
    {
        return ['admin', 'manager'];
    }
    
    // ... rest of your report implementation
}
```

## 3. Panel-Specific Directories

Configure different directories for different panels in your config file:

```php
// config/filament-reports.php
return [
    'reports_directory' => app_path('Filament/Reports'),
    'reports_namespace' => 'App\\Filament\\Reports',
    
    // Panel-specific configurations
    'panel_reports' => [
        'admin' => [
            'directory' => app_path('Filament/AdminReports'),
            'namespace' => 'App\\Filament\\AdminReports',
        ],
        'customer' => [
            'directory' => app_path('Filament/CustomerReports'),
            'namespace' => 'App\\Filament\\CustomerReports',
        ],
        'manager' => [
            'directory' => app_path('Filament/ManagerReports'),
            'namespace' => 'App\\Filament\\ManagerReports',
        ],
    ],
];
```

Then create the appropriate directory structure:
```
app/
├── Filament/
│   ├── Reports/          # Default reports
│   ├── AdminReports/     # Admin-only reports
│   ├── CustomerReports/  # Customer-only reports
│   └── ManagerReports/   # Manager-only reports
```

## 4. Combining Multiple Approaches

You can combine multiple filtering approaches for maximum flexibility:

```php
// Panel provider
public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->plugins([
            ReportsPlugin::make()
                // Start with specific reports
                ->reports([
                    UserReport::class,
                    OrderReport::class,
                    SalesReport::class,
                ])
                // Then exclude some conditionally
                ->excludeReports([
                    // Conditionally exclude based on user permissions
                    auth()->user()->can('view-sensitive-reports') ? [] : [SensitiveReport::class]
                ])
                // Apply final custom filtering
                ->filterReports(function (string $reportClass, Panel $panel) {
                    $report = app($reportClass);
                    
                    // Additional business logic
                    if ($report instanceof TimeSensitiveReport) {
                        return $report->isCurrentlyAvailable();
                    }
                    
                    return true;
                })
        ]);
}
```

## 5. Real-World Example

Here's a complete example showing how you might set up different panels for different user roles:

### Admin Panel
```php
// AdminPanelProvider.php
ReportsPlugin::make()
    ->reports([
        UserReport::class,
        OrderReport::class,
        SalesReport::class,
        FinancialReport::class,
        SystemReport::class,
    ])
```

### Manager Panel
```php
// ManagerPanelProvider.php
ReportsPlugin::make()
    ->reports([
        SalesReport::class,
        OrderReport::class,
        TeamPerformanceReport::class,
    ])
    ->excludeReports([
        SystemReport::class, // Managers don't need system reports
    ])
```

### Customer Panel
```php
// CustomerPanelProvider.php
ReportsPlugin::make()
    ->filterReports(function (string $reportClass, Panel $panel) {
        $report = app($reportClass);
        
        // Only show customer-facing reports
        return $report->group === 'customer' || 
               $report instanceof CustomerAccessibleReport;
    })
```

## Benefits

1. **Clean Separation**: Different user roles see only relevant reports
2. **Flexible Configuration**: Multiple ways to achieve the same goal
3. **Maintainable**: Easy to manage which reports appear where
4. **Secure**: Prevent users from seeing reports they shouldn't access
5. **Performant**: Only discovers and loads relevant reports per panel

## Best Practices

1. **Use panel-specific directories** for completely separate report sets
2. **Use plugin-level filtering** for shared reports with different visibility
3. **Use report-level configuration** for reports that know their own scope
4. **Combine approaches** for complex scenarios
5. **Document your filtering logic** for team clarity
