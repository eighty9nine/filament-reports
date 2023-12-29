# Elegant reports in your filament application

[Check out the demo here](https://reports-demo.eightynine.dev/demo)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

The package is still private, so you need to add the repository to your composer.json file:
```json
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:eighty9nine/filament-reports.git"
        }
    ]
```

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
php artisan make:report UsersReport
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
                            ->data(
                                fn(?array $filters) => $this->registrationSummary($filters)
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
