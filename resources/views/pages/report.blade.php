@php
    $cellStyle = 'padding-left:48px; padding-right:48px;  padding-top: 20px; vertical-align: top;';
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
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell style="padding-top:48px;">
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell style="{{ $cellStyle }}">
                {{-- heading section --}}
                {{ $this->header }}
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell style="{{ $cellStyle }}">
                {{-- body section --}}
                {{ $this->body }}
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell style="{{ $cellStyle }}">
                {{-- footer section --}}
                {{ $this->footer }}
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
        <x-filament-reports::table.row>
            <x-filament-reports::table.cell style="padding-top:48px;">
            </x-filament-reports::table.cell>
        </x-filament-reports::table.row>
    </x-filament-reports::table.index>
</x-filament-panels::page>
