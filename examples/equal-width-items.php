<?php

// Example: Creating equal width items in columns

use EightyNine\Reports\Components\Body\Layout\BodyColumn;
use EightyNine\Reports\Components\Body\Layout\BodyRow;
use EightyNine\Reports\Components\Text;

// Method 1: Using Flexbox for equal width items
$column = BodyColumn::make([
    Text::make('Item 1 - Short')
        ->extraAttributes([
            'style' => 'flex: 1; min-width: 0; margin-bottom: 10px;',
            'class' => 'equal-width-item'
        ]),
    
    Text::make('Item 2 - Much longer text content')
        ->extraAttributes([
            'style' => 'flex: 1; min-width: 0; margin-bottom: 10px;',
            'class' => 'equal-width-item'
        ]),
    
    Text::make('Item 3 - Medium')
        ->extraAttributes([
            'style' => 'flex: 1; min-width: 0; margin-bottom: 10px;',
            'class' => 'equal-width-item'
        ]),
])
->extraAttributes([
    'style' => 'display: flex; flex-direction: column; gap: 10px;',
    'class' => 'equal-width-column'
]);

// Method 2: Using CSS Grid for precise control
$gridColumn = BodyColumn::make([
    Text::make('Grid Item 1'),
    Text::make('Grid Item 2 with longer content'),
    Text::make('Grid Item 3'),
])
->extraAttributes([
    'style' => 'display: grid; grid-template-rows: repeat(auto-fit, 1fr); gap: 10px; width: 100%;',
    'class' => 'grid-equal-width'
]);

// Method 3: Using table layout for items
$tableColumn = BodyColumn::make([
    BodyRow::make([
        Text::make('Table Item 1')
            ->extraCellAttributes([
                'style' => 'width: 100%; display: table-cell;'
            ])
    ])
    ->extraAttributes(['style' => 'display: table; width: 100%; margin-bottom: 5px;']),
    
    BodyRow::make([
        Text::make('Table Item 2 with more content')
            ->extraCellAttributes([
                'style' => 'width: 100%; display: table-cell;'
            ])
    ])
    ->extraAttributes(['style' => 'display: table; width: 100%; margin-bottom: 5px;']),
    
    BodyRow::make([
        Text::make('Table Item 3')
            ->extraCellAttributes([
                'style' => 'width: 100%; display: table-cell;'
            ])
    ])
    ->extraAttributes(['style' => 'display: table; width: 100%;']),
]);

// Method 4: Using percentage widths
$percentageColumn = BodyColumn::make([
    Text::make('25% Width Item')
        ->extraAttributes([
            'style' => 'width: 25%; display: inline-block; vertical-align: top;'
        ]),
    
    Text::make('50% Width Item with more content')
        ->extraAttributes([
            'style' => 'width: 50%; display: inline-block; vertical-align: top;'
        ]),
    
    Text::make('25% Width Item')
        ->extraAttributes([
            'style' => 'width: 25%; display: inline-block; vertical-align: top;'
        ]),
])
->extraAttributes([
    'style' => 'width: 100%; white-space: nowrap;',
    'class' => 'percentage-width-column'
]);
