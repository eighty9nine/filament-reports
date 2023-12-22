@php
    $size = $getSize();
@endphp
<x-filament-reports::table.index>
    <x-filament-reports::table.row>
        <x-filament-reports::table.cell
            class="pad"
            style="padding-top:{{ $size }};">
        </x-filament-reports::table.cell>
    </x-filament-reports::table.row>
</x-filament-reports::table.index>
