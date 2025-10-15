<?php

namespace Examples;

use EightyNine\Reports\Components\Body\Table;
use EightyNine\Reports\Components\Body\TextColumn;
use EightyNine\Reports\Components\Header\Layout\HeaderColumn;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Report;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GroupedItemSalesReport extends Report
{
    public ?string $heading = 'Item Sales Report by Category';

    public ?string $icon = 'heroicon-o-chart-bar';

    public ?string $subHeading = 'A report showing sales data grouped by product categories';

    public function header(Schema $schema): Schema
    {
        return $schema
            ->components([
                HeaderColumn::make()
                    ->schema([
                        Text::make('Item Sales Report by Category')
                            ->title()
                            ->primary(),                        Text::make('A comprehensive report showing sales data organized by product categories with totals')
                            ->subTitle()
                            ->primary(),
                    ]),
            ]);
    }

    public function body(Schema $schema): Schema
    {
        // Sample data - replace with your actual data source
        $items = collect([
            ['id' => 1, 'name' => 'Item 1', 'category' => 'Category 1', 'sales' => 1000.00],
            ['id' => 2, 'name' => 'Item 2', 'category' => 'Category 1', 'sales' => 1500.00],
            ['id' => 3, 'name' => 'Item 3', 'category' => 'Category 1', 'sales' => 750.00],
            ['id' => 4, 'name' => 'Item 6', 'category' => 'Category 2', 'sales' => 980.00],
            ['id' => 5, 'name' => 'Item 7', 'category' => 'Category 2', 'sales' => 200.00],
        ]);

        // Transform data to include category totals and group structure
        $groupedData = $this->prepareGroupedData($items);

        return $schema
            ->components([
                Table::make()
                    ->data(fn () => $groupedData)
                    ->columns([
                        TextColumn::make('item_name')
                            ->label('Item')
                            ->groupRows()
                            ->weight('bold', fn ($record) => $record['is_category'] ?? false),

                        TextColumn::make('sales')
                            ->label('Sales')
                            ->formatStateUsing(fn ($state) => '$'.number_format($state, 2))->weight('bold', fn ($record) => $record['is_category'] ?? false)
                            ->alignEnd(),
                    ]),
            ]);
    }

    public function footer(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Footer content can be added here if needed
            ]);
    }

    public function filterForm(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('category_filter')
                    ->label('Filter by Category')
                    ->placeholder('Enter category name...'),
                TextInput::make('min_sales')
                    ->label('Minimum Sales Amount')
                    ->numeric()
                    ->placeholder('Enter minimum sales amount...'),
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Sales Reports';
    }

    /**
     * Prepare data for grouped display with category totals
     */
    private function prepareGroupedData($items)
    {
        $grouped = $items->groupBy('category');
        $result = collect();

        foreach ($grouped as $categoryName => $categoryItems) {
            // Calculate category total
            $categoryTotal = $categoryItems->sum('sales');

            // Add category header row
            $result->push([
                'item_name' => $categoryName,
                'sales' => $categoryTotal,
                'is_category' => true,
                'category' => $categoryName,
            ]);

            // Add individual items under the category
            foreach ($categoryItems as $item) {
                $result->push([
                    'item_name' => $item['name'],
                    'sales' => $item['sales'],
                    'is_category' => false,
                    'category' => $categoryName,
                ]);
            }
        }

        return $result;
    }

    /**
     * Alternative method using Laravel Eloquent models
     * Uncomment and modify this if you're using Eloquent models
     */
    /*
    private function prepareGroupedDataFromModels()
    {
        // Assuming you have Item and Category models
        $items = \App\Models\Item::with('category')
            ->selectRaw('items.*, categories.name as category_name')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->orderBy('categories.name')
            ->orderBy('items.name')
            ->get();

        $grouped = $items->groupBy('category_name');
        $result = collect();

        foreach ($grouped as $categoryName => $categoryItems) {
            $categoryTotal = $categoryItems->sum('sales_amount');

            // Category header
            $result->push([
                'item_name' => $categoryName,
                'sales' => $categoryTotal,
                'is_category' => true,
                'category' => $categoryName,
            ]);

            // Individual items
            foreach ($categoryItems as $item) {
                $result->push([
                    'item_name' => $item->name,
                    'sales' => $item->sales_amount,
                    'is_category' => false,                    'category' => $categoryName,
                ]);
            }
        }

        return $result;
    }
    */
}
