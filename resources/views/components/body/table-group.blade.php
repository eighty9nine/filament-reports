<x-filament-reports::table.index style="width:100%">
    @foreach ($getChildComponents() as $reportComponent)
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell>
                {{ $reportComponent }}
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
    @endforeach
</x-filament-reports::table.index>
