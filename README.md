# Elegant reports in your filament application

[Check out the demo here](https://filament-reports.eightynine.dev/demo)

[Full Documentation](https://filament-reports.eightynine.dev/docs)

## Requirements

- PHP 8.2 or higher
- Laravel 10.0, 11.0, or 12.0
- Filament 3.0 or higher

> **Note:** Laravel 12 support is now available! If you're upgrading from a previous version, please ensure your PHP version is 8.2 or higher as this is required for Laravel 12 compatibility.

## 🛠️ Be Part of the Journey

Hi, I'm Eighty Nine. I created reports plugin to solve real problems I faced as a developer. Your sponsorship will allow me to dedicate more time to enhancing these tools and helping more people. [Become a sponsor](https://github.com/sponsors/eighty9nine) and join me in making a positive impact on the developer community.

## Installation

Then you can install the package via composer:

```bash
composer require eightynine/filament-reports
```

You can publish the configuration using:
```bash
php artisan vendor:publish --provider="EightyNine\Reports\ReportsServiceProvider" --tag="reports-config"
```

## Usage

### Register the plugin
Add the plugin to your panel service provider, this is for page discovery and adding the reports to the navigation
```php

use EightyNine\Reports\ReportsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('demo')
        ->path('demo')
        ...
        ->plugins([
            ReportsPlugin::make()
        ]);
}
```
### Create your first report
The package comes packed with a report creation command, this will create a report in the `app/Filament/Reports` directory.
```bash
php artisan make:filament-report UsersReport
```
The command will create a report class with the following structure:
```php

namespace App\Filament\Reports;

use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use Filament\Forms\Form;

class UserReport extends Report
{
    public ?string $heading = "Report";

    // public ?string $subHeading = "A report";

    public function header(Header $header): Header
    {
        return $header
            ->schema([
                // ...
            ]);
    }


    public function body(Body $body): Body
    {
        return $body
            ->schema([
                // ...
            ]);
    }

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                // ...
            ]);
    }

    public function filterForm(Form $form): Form
    {
        return $form
            ->schema([
                // ...
            ]);
    }
}

````

## Using Reports in Multiple Panels

When working with multiple Filament panels (e.g., admin, customer, manager panels), you may want to display different reports in each panel or share reports across specific panels only. The plugin provides several flexible approaches to achieve this:

### 1. Plugin-Level Filtering

Configure which reports appear in each panel when registering the plugin:

**Allow Only Specific Reports:**
```php
// AdminPanelProvider.php
use EightyNine\Reports\ReportsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->plugins([
            ReportsPlugin::make()
                ->reports([
                    \App\Filament\Reports\UserReport::class,
                    \App\Filament\Reports\OrderReport::class,
                    \App\Filament\Reports\FinancialReport::class,
                ])
        ]);
}
```

**Exclude Specific Reports:**
```php
// CustomerPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->id('customer')
        ->plugins([
            ReportsPlugin::make()
                ->excludeReports([
                    \App\Filament\Reports\AdminReport::class,
                    \App\Filament\Reports\SystemReport::class,
                ])
        ]);
}
```

**Custom Filter Logic:**
```php
// ManagerPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->id('manager')
        ->plugins([
            ReportsPlugin::make()
                ->filterReports(function (string $reportClass, Panel $panel) {
                    $report = app($reportClass);
                    // Only show sales and finance reports to managers
                    return in_array($report->group, ['sales', 'finance']);
                })
        ]);
}
```

### 2. Report-Level Panel Configuration

Configure directly in your report class which panels it should appear in:

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

### 3. Panel-Specific Directories

Use completely separate directories for different panels by configuring them in your config file:

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
    ],
];
```

Then create the directory structure:
```
app/
├── Filament/
│   ├── Reports/          # Default reports (shared)
│   ├── AdminReports/     # Admin-only reports
│   └── CustomerReports/  # Customer-only reports
```

### 4. Combining Approaches

You can combine multiple filtering approaches for maximum flexibility:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->plugins([
            ReportsPlugin::make()
                ->reports([
                    UserReport::class,
                    OrderReport::class,
                    SalesReport::class,
                ])
                ->excludeReports([
                    // Conditionally exclude based on user permissions
                    auth()->user()->can('view-sensitive-reports') ? [] : [SensitiveReport::class]
                ])
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

### Benefits

- **Clean Separation**: Different user roles see only relevant reports
- **Flexible Configuration**: Multiple ways to achieve the same goal
- **Maintainable**: Easy to manage which reports appear where
- **Secure**: Prevent users from seeing reports they shouldn't access
- **Performant**: Only discovers and loads relevant reports per panel

---

The report has the following sections:
- Header
- Body
- Footer
- Filter Form

### Header
The header is the top section of the report, it can be used to display a title, subtitle, image and a description. If
the section is left empty, nothing will be displayed, but if you have a custom header for your report, this is where you
can define it.

The header area has layouts that can be used to arrange items. The layouts are `HeaderColumn` and `HeaderRow`.

- `HeaderColumn` is a vertical layout, it will stack the items on top of each other. Items inside the `HeaderColumn` can
aligned vertically and horizontally, depending on how you wish to align the items.
- `HeaderRow` is a horizontal layout, it will place the items next to each other. Items inside the `HeaderRow` can be aligned
vertically and horizontally, depending on how you wish to align the items.

The `HeaderColumn` and `HeaderRow` can be nested inside each other to create more complex layouts.

Apart from the Layouts, the header also has components that can be used to display data. The components are:
- `Text` - This is used to display text, it can be used to display a title or a subtitle, or with any styling you may prefer.
- `Image` - This is used to display an image, it can be used to display a logo or any other image you may want to display.

Here is an example of the header section:
```php

    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                ->schema([
                    Header\Layout\HeaderColumn::make()
                        ->schema([
                            Text::make("User registration report")
                                ->title()
                                ->primary(),
                            Text::make("A user registration report")
                                ->subtitle(),
                        ]),
                    Header\Layout\HeaderColumn::make()
                        ->schema([
                            Image::make($imagePath),
                        ])
                        ->alignRight(),
                ]),
            ]);
    }

````

### Body
The body is the main section of the report, it can be used to display a table, chart or any other data. If the section
is left empty, nothing will be displayed.

The body area has layouts that can be used to arrange items. The layouts are `BodyColumn` and `BodyRow`.
These behave the same as the `HeaderColumn` and `HeaderRow` but are used for the body section. But they are used specifically
for the body section, because they have different styling.

Apart from the Layouts, the body also has components that can be used to display data. The components are:
- `Table` - This is used to display a table, it can be used to display a list of data.
- `VerticalSpace` - This is used to add vertical spacing between items.

The `Text` and `Image` components can also be used in the body section.

Here is an example of the body section:
```php

    public function body(Body $body): Body
    {
        return $body
            ->schema([
                Body\Layout\BodyColumn::make()
                    ->schema([
                        Body\Table::make()
                            ->columns([
                                EightyNine\Reports\Components\Body\TextColumn::make("name"),
                                EightyNine\Reports\Components\Body\TextColumn::make("age")
                                    ->numeric()
                            ])
                            ->data(
                                fn(?array $filters) => collect([
                                    [ "name" => "One",   "age" => 5 ],
                                    [ "name" => "Two",   "age" => 5 ],
                                    [ "name" => "Three", "age" => 5 ],
                                    [ "name" => "Four",  "age" => 5 ],
                                ])
                            ),
                        VerticalSpace::make(),
                        Body\Table::make()
                            ->data(
                                fn(?array $filters) => $this->verificationSummary($filters)
                            ),
                    ]),
            ]);
    }


```
### Footer
The footer is the bottom section of the report, it can be used to display a title, subtitle, image and a description. It has layouts and components that behave the same as the header section.
The footer section has the `Text` and `Image` components, and the `FooterColumn` and `FooterRow` layouts.

```php

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                Footer\Layout\FooterRow::make()
                    ->schema([
                        Footer\Layout\FooterColumn::make()
                            ->schema([
                                Text::make("Footer title")
                                    ->title()
                                    ->primary(),
                                Text::make("Footer subtitle")
                                    ->subtitle(),
                            ]),
                        Footer\Layout\FooterColumn::make()
                            ->schema([
                                Text::make("Generated on: " . now()->format('Y-m-d H:i:s')),
                            ])
                            ->alignRight(),
                    ]),
            ]);
    }
```

### Filter Form
The filter form is used to filter the data that is displayed in the report. The filter form uses the Filament form builder
so you can use any of the form components that are available in Filament. The form is displayed on the side of the report, and the 
filter data will be available in all the tables `data()` callback. This will be explained further in the below sections.

Example of a filter form:
```php

public function filterForm(Form $form): Form
{
    return $form
        ->schema([
            Input::make('search')
                ->placeholder('Search')
                ->autofocus()
                ->iconLeft('heroicon-o-search'),
            Select::make('status')
                ->placeholder('Status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ]),
        ]);
}
```

### Group rows
You can group a column in multiple rows, in order to show related data.

> Please note, it is important to order by the column you wish to group the rows by, otherwise, there will be multiple groups

```php
    use EightyNine\Reports\Components\Body\TextColumn;

    Body\Table::make()
        ->columns([
            TextColumn::make("location")
                ->groupRows(),
            TextColumn::make("name"),
            TextColumn::make("age")
                ->numeric()
        ])
        ->data(
            fn(?array $filters) => collect([
                ["location"=>"New York", "name" => "One",   "age" => 5 ],
                ["location"=>"New York", "name" => "Two",   "age" => 5 ],
                ["location"=>"Florida", "name" => "Three", "age" => 5 ],
                ["location"=>"New York", "name" => "Four",  "age" => 5 ],
            ])->orderBy('location')
        ),
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Eighty Nine](https://github.com/eighty9nine)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
