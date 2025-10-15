<?php

// Complete example showing how to register custom CSS and implement justified layouts

use EightyNine\Reports\Components\Body\Layout\BodyColumn;
use EightyNine\Reports\Components\Body\Layout\BodyRow;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\Schemas\Schema;

class JustifiedLayoutReport extends Report
{
    public function setUp(): void
    {
        // Register custom CSS for equal heights and widths
        FilamentAsset::register([
            Css::make('custom-layout-styles', resource_path('css/custom-layout-styles.css')),
        ]);
    }

    public function body(Schema $schema): Schema
    {
        return $schema->components([
            // Example 1: Equal height columns with justified content
            BodyRow::make([
                BodyColumn::make([
                    Text::make('Short Content')
                        ->alignTop(),
                    Text::make('Bottom aligned text')
                        ->alignBottom()
                        ->extraAttributes([
                            'style' => 'margin-top: auto;',
                        ]),
                ])
                    ->extraAttributes([
                        'class' => 'justified-column',
                        'style' => 'display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;',
                    ]),

                BodyColumn::make([
                    Text::make('This is a much longer piece of content that will naturally take up more space and demonstrate how the equal height system works when content varies significantly in length'),
                    Text::make('Additional content'),
                    Text::make('Bottom content')
                        ->extraAttributes([
                            'style' => 'margin-top: auto;',
                        ]),
                ])
                    ->extraAttributes([
                        'class' => 'justified-column',
                        'style' => 'display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;',
                    ]),

                BodyColumn::make([
                    Text::make('Medium length content that falls between the short and long examples'),
                    Text::make('Final item')
                        ->extraAttributes([
                            'style' => 'margin-top: auto;',
                        ]),
                ])
                    ->extraAttributes([
                        'class' => 'justified-column',
                        'style' => 'display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;',
                    ]),
            ])
                ->extraAttributes([
                    'class' => 'equal-height-row',
                    'style' => 'display: flex; align-items: stretch; margin-bottom: 30px;',
                ]),

            // Example 2: Equal width items in a column with justified spacing
            BodyColumn::make([
                BodyRow::make([
                    Text::make('Item 1')
                        ->extraAttributes([
                            'style' => 'flex: 1; text-align: center; padding: 15px; border: 1px solid #ccc;',
                        ]),
                    Text::make('Item 2 - Longer')
                        ->extraAttributes([
                            'style' => 'flex: 1; text-align: center; padding: 15px; border: 1px solid #ccc;',
                        ]),
                    Text::make('Item 3')
                        ->extraAttributes([
                            'style' => 'flex: 1; text-align: center; padding: 15px; border: 1px solid #ccc;',
                        ]),
                ])
                    ->extraAttributes([
                        'style' => 'display: flex; gap: 10px; justify-content: space-between; margin-bottom: 15px;',
                    ]),

                BodyRow::make([
                    Text::make('Row 2 Item 1')
                        ->extraAttributes([
                            'style' => 'flex: 1; text-align: center; padding: 15px; border: 1px solid #ccc;',
                        ]),
                    Text::make('Row 2 Item 2')
                        ->extraAttributes([
                            'style' => 'flex: 1; text-align: center; padding: 15px; border: 1px solid #ccc;',
                        ]),
                    Text::make('Row 2 Item 3')
                        ->extraAttributes([
                            'style' => 'flex: 1; text-align: center; padding: 15px; border: 1px solid #ccc;',
                        ]),
                ])
                    ->extraAttributes([
                        'style' => 'display: flex; gap: 10px; justify-content: space-between;',
                    ]),
            ])
                ->extraAttributes([
                    'class' => 'equal-width-container',
                ]),

            // Example 3: Advanced grid layout with equal dimensions
            BodyRow::make([
                BodyColumn::make([
                    Text::make('Grid Item 1')->alignCenter(),
                ])
                    ->extraAttributes([
                        'style' => 'display: flex; align-items: center; justify-content: center; min-height: 150px; border: 2px solid #3b82f6; background-color: #eff6ff;',
                    ]),

                BodyColumn::make([
                    Text::make('Grid Item 2')->alignCenter(),
                ])
                    ->extraAttributes([
                        'style' => 'display: flex; align-items: center; justify-content: center; min-height: 150px; border: 2px solid #10b981; background-color: #ecfdf5;',
                    ]),

                BodyColumn::make([
                    Text::make('Grid Item 3')->alignCenter(),
                ])
                    ->extraAttributes([
                        'style' => 'display: flex; align-items: center; justify-content: center; min-height: 150px; border: 2px solid #f59e0b; background-color: #fffbeb;',
                    ]),
            ])
                ->extraAttributes([
                    'style' => 'display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px;',
                ]),
        ]);
    }

    // Alternative method using CSS classes instead of inline styles
    public function getBodyWithCssClasses(): Schema
    {
        return Schema::make()->components([
            BodyRow::make([
                BodyColumn::make([
                    Text::make('CSS Class Column 1'),
                ])
                    ->extraAttributes(['class' => 'justified-column']),

                BodyColumn::make([
                    Text::make('CSS Class Column 2 with more content to test height differences'),
                ])
                    ->extraAttributes(['class' => 'justified-column']),

                BodyColumn::make([
                    Text::make('CSS Class Column 3'),
                ])
                    ->extraAttributes(['class' => 'justified-column']),
            ])
                ->extraAttributes(['class' => 'equal-height-row']),

            BodyColumn::make([
                Text::make('Equal width item 1'),
                Text::make('Equal width item 2 with longer text'),
                Text::make('Equal width item 3'),
            ])
                ->extraAttributes(['class' => 'equal-width-column']),
        ]);
    }
}
