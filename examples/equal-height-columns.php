<?php

// Example: Creating equal height columns in a row

use EightyNine\Reports\Components\Body\Layout\BodyRow;
use EightyNine\Reports\Components\Body\Layout\BodyColumn;
use EightyNine\Reports\Components\Text;

// Method 1: Using CSS Flexbox with extraAttributes
$row = BodyRow::make([
    BodyColumn::make([
        Text::make('Column 1 content that might be shorter'),
    ])
    ->extraAttributes([
        'style' => 'display: flex; flex-direction: column; height: 100%;'
    ]),
    
    BodyColumn::make([
        Text::make('Column 2 content that might be much longer and span multiple lines to demonstrate height differences'),
    ])
    ->extraAttributes([
        'style' => 'display: flex; flex-direction: column; height: 100%;'
    ]),
    
    BodyColumn::make([
        Text::make('Column 3 content'),
    ])
    ->extraAttributes([
        'style' => 'display: flex; flex-direction: column; height: 100%;'
    ]),
])
->extraAttributes([
    'style' => 'display: flex; align-items: stretch; min-height: 200px;',
    'class' => 'equal-height-row'
]);

// Method 2: Using CSS Grid
$gridRow = BodyRow::make([
    BodyColumn::make([
        Text::make('Grid Column 1'),
    ]),
    BodyColumn::make([
        Text::make('Grid Column 2 with more content'),
    ]),
    BodyColumn::make([
        Text::make('Grid Column 3'),
    ]),
])
->extraAttributes([
    'style' => 'display: grid; grid-template-columns: 1fr 1fr 1fr; grid-auto-rows: 1fr;',
    'class' => 'grid-equal-height'
]);

// Method 3: Using table display with equal heights
$tableRow = BodyRow::make([
    BodyColumn::make([
        Text::make('Table Column 1'),
    ])
    ->extraCellAttributes([
        'style' => 'vertical-align: top; height: 100%;'
    ]),
    
    BodyColumn::make([
        Text::make('Table Column 2'),
    ])
    ->extraCellAttributes([
        'style' => 'vertical-align: top; height: 100%;'
    ]),
])
->extraAttributes([
    'style' => 'display: table; width: 100%; table-layout: fixed;'
]);
