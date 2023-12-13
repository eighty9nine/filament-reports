@php
    $sections = $this->sections;
@endphp
<x-filament-panels::page>
    <x-filament-reports::table.index
        style="
        min-width:100%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        border: 1px solid whitesmoke;
        ">
        @foreach ($sections as $section)
            <x-filament-reports::table.row>
                <x-filament-reports::table.cell
                    style="{{ $section == 'pad'
                        ? 'padding-top:48px;'
                        : 'padding-left:48px; padding-right:48px;  padding-top: 20px; vertical-align: top;' }}">
                    @if ($section != 'pad')
                        {{ $this->$section }}
                    @endif
                </x-filament-reports::table.cell>
            </x-filament-reports::table.row>
        @endforeach
    </x-filament-reports::table.index>
</x-filament-panels::page>
