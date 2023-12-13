@php
    use EightyNine\Reports\Enums\VerticalAlignment;
    use EightyNine\Reports\Enums\HorizontalAlignment;

    $verticalAlignment = match ($getVerticalAlignment()) {
        VerticalAlignment::Top => 'vertical-align:top;',
        VerticalAlignment::Middle => 'vertical-align:middle;',
        VerticalAlignment::Bottom => 'vertical-align:bottom;',
    };

    $horizontalAlignment = match ($getHorizontalAlignment()) {
        HorizontalAlignment::Right => 'text-align:right;',
        HorizontalAlignment::Left => 'text-align:left;',
        HorizontalAlignment::Center => 'text-align:center;',
    };
@endphp
<x-filament-reports::table.index style="width:100%;">
    @foreach ($getChildComponents() as $reportComponent)
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell style="
            {{ $horizontalAlignment }}
            {{ $verticalAlignment }}
            ">
                {{ $reportComponent }}
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
    @endforeach
</x-filament-reports::table.index>
