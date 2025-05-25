<?php

namespace Examples;

use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Body\TextColumn;
use EightyNine\Reports\Components\Body\Table;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use EightyNine\Reports\Components\Header\Layout\HeaderColumn;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;

class AdvancedGroupedReport extends Report
{
    public ?string $heading = "Advanced Grouped Sales Report";
    public function header(Header $header): Header
    {
        return $header
            ->schema([
                HeaderColumn::make()
                    ->schema([
                        Text::make('Advanced Sales Report with Multiple Grouping Options')
                            ->title()
                            ->primary(),
                    ])
            ]);
    }
    public function body(Body $body): Body
    {
        return $body
            ->schema([
                $this->createSimpleGroupedTable(),
                $this->createHierarchicalGroupedTable(),
                $this->createMultiLevelGroupedTable(),
            ]);
    }

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                // Footer content can be added here if needed
            ]);
    }

    /**
     * Simple grouped table with category totals
     */
    private function createSimpleGroupedTable()
    {
        $data = $this->prepareSimpleGroupedData();

        return Table::make()
            ->data(fn() => $data)
            ->columns([
                TextColumn::make('is_group')
                    ->label('Group')
                    ->hidden(),
                TextColumn::make('display_name')
                    ->label('Item/Category')
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record['is_group'] ? $state : '  └─ ' . $state
                    )
                    ->weight(fn($record) => $record['is_group'] ? 'bold' : 'normal')
                    ->color(fn($record) => $record['is_group'] ? 'primary' : null),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2))
                    ->weight(fn($record) => $record['is_group'] ? 'bold' : 'normal')
                    ->alignEnd(),
                TextColumn::make('quantity')
                    ->label('Qty')
                    ->formatStateUsing(fn($state) => $state ? number_format($state) : '')
                    ->alignEnd(),
            ]);
    }

    /**
     * Hierarchical grouped table with visual indentation
     */
    private function createHierarchicalGroupedTable()
    {
        $data = $this->prepareHierarchicalData();
        return Table::make()
            ->data(fn() => $data)
            ->columns([
                TextColumn::make('display_name')
                    ->label('Category → Subcategory → Item')
                    ->formatStateUsing(function ($state, $record) {
                        $indent = str_repeat('  ', $record['level']);
                        $prefix = match ($record['level']) {
                            0 => '📁 ',
                            1 => '├─ 📂 ',
                            2 => '└─ 📄 ',
                            default => '  └─ '
                        };
                        return $indent . $prefix . $state;
                    })
                    ->weight(fn($record) => $record['level'] < 2 ? 'bold' : 'normal')
                    ->color(fn($record) => match ($record['level']) {
                        0 => 'primary',
                        1 => 'secondary',
                        default => null
                    }),
                TextColumn::make('sales')
                    ->label('Sales')
                    ->formatStateUsing(fn($state) => $state ? '$' . number_format($state, 2) : '')
                    ->weight(fn($record) => $record['level'] < 2 ? 'bold' : 'normal')
                    ->alignEnd(),
                TextColumn::make('level')
                    ->label('Level')
                    ->hidden()
            ]);
    }

    /**
     * Multi-level grouped table with subtotals
     */
    private function createMultiLevelGroupedTable()
    {
        $data = $this->prepareMultiLevelData();
        return Table::make()
            ->data(fn() => $data)
            ->columns([
                TextColumn::make('item_description')
                    ->label('Description')
                    ->formatStateUsing(function ($state, $record) {
                        return match ($record['type']) {
                            'grand_total' => '═══ GRAND TOTAL ═══',
                            'category_total' => $record['category'] . ' (Total)',
                            'subcategory_total' => '  ├─ ' . $record['subcategory'] . ' (Subtotal)',
                            'item' => '  │  └─ ' . $state,
                            default => $state
                        };
                    })
                    ->weight(fn($record) => in_array($record['type'], ['grand_total', 'category_total', 'subcategory_total']) ? 'bold' : 'normal')
                    ->color(function ($record) {
                        return match ($record['type']) {
                            'grand_total' => 'danger',
                            'category_total' => 'primary',
                            'subcategory_total' => 'secondary',
                            default => null
                        };
                    }),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2))
                    ->weight(fn($record) => in_array($record['type'], ['grand_total', 'category_total', 'subcategory_total']) ? 'bold' : 'normal')
                    ->alignEnd(),

                TextColumn::make('percentage')
                    ->label('% of Total')
                    ->formatStateUsing(fn($state) => $state ? number_format($state, 1) . '%' : '')
                    ->alignEnd(),

                TExtColumn::make('type')
                    ->label('Type')
                    ->hidden(),
            ]);
    }

    /**
     * Prepare simple grouped data
     */
    private function prepareSimpleGroupedData()
    {
        $items = collect([
            ['name' => 'Widget A', 'category' => 'Electronics', 'amount' => 1250.00, 'quantity' => 25],
            ['name' => 'Widget B', 'category' => 'Electronics', 'amount' => 880.00, 'quantity' => 12],
            ['name' => 'Gadget X', 'category' => 'Electronics', 'amount' => 2100.00, 'quantity' => 8],
            ['name' => 'Tool 1', 'category' => 'Hardware', 'amount' => 650.00, 'quantity' => 15],
            ['name' => 'Tool 2', 'category' => 'Hardware', 'amount' => 320.00, 'quantity' => 8],
            ['name' => 'Book A', 'category' => 'Books', 'amount' => 45.00, 'quantity' => 30],
            ['name' => 'Book B', 'category' => 'Books', 'amount' => 68.00, 'quantity' => 22],
        ]);

        $grouped = $items->groupBy('category');
        $result = collect();

        foreach ($grouped as $categoryName => $categoryItems) {
            $categoryTotal = $categoryItems->sum('amount');
            $totalQuantity = $categoryItems->sum('quantity');

            // Category header
            $result->push([
                'display_name' => $categoryName,
                'amount' => $categoryTotal,
                'quantity' => $totalQuantity,
                'is_group' => true,
            ]);

            // Items
            foreach ($categoryItems as $item) {
                $result->push([
                    'display_name' => $item['name'],
                    'amount' => $item['amount'],
                    'quantity' => $item['quantity'],
                    'is_group' => false,
                ]);
            }
        }

        return $result;
    }

    /**
     * Prepare hierarchical data with multiple levels
     */
    private function prepareHierarchicalData()
    {
        $data = [
            ['name' => 'Consumer Electronics', 'level' => 0, 'sales' => 5230.00],
            ['name' => 'Smartphones', 'level' => 1, 'sales' => 3200.00],
            ['name' => 'iPhone 14', 'level' => 2, 'sales' => 1800.00],
            ['name' => 'Samsung Galaxy', 'level' => 2, 'sales' => 1400.00],
            ['name' => 'Laptops', 'level' => 1, 'sales' => 2030.00],
            ['name' => 'MacBook Pro', 'level' => 2, 'sales' => 1200.00],
            ['name' => 'Dell XPS', 'level' => 2, 'sales' => 830.00],

            ['name' => 'Home & Garden', 'level' => 0, 'sales' => 1850.00],
            ['name' => 'Furniture', 'level' => 1, 'sales' => 1200.00],
            ['name' => 'Office Chair', 'level' => 2, 'sales' => 450.00],
            ['name' => 'Desk Lamp', 'level' => 2, 'sales' => 750.00],
            ['name' => 'Garden Tools', 'level' => 1, 'sales' => 650.00],
            ['name' => 'Shovel', 'level' => 2, 'sales' => 350.00],
            ['name' => 'Rake', 'level' => 2, 'sales' => 300.00],
        ];

        return collect($data)->map(fn($item) => [
            'display_name' => $item['name'],
            'sales' => $item['sales'],
            'level' => $item['level'],
        ]);
    }

    /**
     * Prepare multi-level data with percentages
     */
    private function prepareMultiLevelData()
    {
        $grandTotal = 12500.00;

        return collect([
            // Category 1
            ['item_description' => '', 'category' => 'Technology', 'amount' => 8500.00, 'percentage' => 68.0, 'type' => 'category_total'],
            ['item_description' => '', 'subcategory' => 'Hardware', 'amount' => 5500.00, 'percentage' => 44.0, 'type' => 'subcategory_total'],
            ['item_description' => 'Laptop Sales', 'amount' => 3200.00, 'percentage' => 25.6, 'type' => 'item'],
            ['item_description' => 'Desktop Sales', 'amount' => 2300.00, 'percentage' => 18.4, 'type' => 'item'],
            ['item_description' => '', 'subcategory' => 'Software', 'amount' => 3000.00, 'percentage' => 24.0, 'type' => 'subcategory_total'],
            ['item_description' => 'License Sales', 'amount' => 1800.00, 'percentage' => 14.4, 'type' => 'item'],
            ['item_description' => 'Support Contracts', 'amount' => 1200.00, 'percentage' => 9.6, 'type' => 'item'],

            // Category 2  
            ['item_description' => '', 'category' => 'Services', 'amount' => 4000.00, 'percentage' => 32.0, 'type' => 'category_total'],
            ['item_description' => '', 'subcategory' => 'Consulting', 'amount' => 2500.00, 'percentage' => 20.0, 'type' => 'subcategory_total'],
            ['item_description' => 'IT Consulting', 'amount' => 1500.00, 'percentage' => 12.0, 'type' => 'item'],
            ['item_description' => 'Business Consulting', 'amount' => 1000.00, 'percentage' => 8.0, 'type' => 'item'],
            ['item_description' => '', 'subcategory' => 'Training', 'amount' => 1500.00, 'percentage' => 12.0, 'type' => 'subcategory_total'],
            ['item_description' => 'Technical Training', 'amount' => 900.00, 'percentage' => 7.2, 'type' => 'item'],
            ['item_description' => 'Management Training', 'amount' => 600.00, 'percentage' => 4.8, 'type' => 'item'],

            // Grand Total
            ['item_description' => '', 'amount' => $grandTotal, 'percentage' => 100.0, 'type' => 'grand_total'],
        ]);
    }
}
