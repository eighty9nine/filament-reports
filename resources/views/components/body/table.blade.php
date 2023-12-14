@php
    $data = $getData();
    $hasHeadings = $hasHeadings();
    $headings = $getHeadings();
    $isFirstColumnUsedAsHeadings = $isFirstColumnUsedAsHeadings();
@endphp
<x-filament-reports::table.index
    class="border-t-4 border-primary-500"
    style="width: 100%;
border-bottom: 1px solid rgb(210, 210, 210);">

    <x-filament-reports::table.head>
        @if ($hasHeadings)
            <x-filament-reports::table.row>
                @foreach ($headings as $heading)
                    <x-filament-reports::table.head-cell
                        style="
                            padding-left: 8px;
                            padding-right: 8px;
                            padding-top: 4px;
                            padding-bottom: 4px;
                            border-bottom: 1px solid #aaa;
                            border-top: 1px solid #aaa;
                            text-align: left;
                            font-weight: bold;
                        ">
                        {{ $heading }}</x-filament-reports::table.head-cell>
                @endforeach
            </x-filament-reports::table.row>
        @endif
    </x-filament-reports::table.head>
    <x-filament-reports::table.body>
        @foreach ($data as $row)
            <x-filament-reports::table.row>
                @foreach ($row as $cell)
                    @if ($loop->first && $isFirstColumnUsedAsHeadings)
                        <x-filament-reports::table.head-cell
                            style="
                            padding-left: 8px;
                            padding-right: 8px;
                            padding-top: 4px;
                            padding-bottom: 4px;
                            border-bottom: 1px solid #aaa;
                            border-top: 1px solid #aaa;
                            text-align: left;
                            font-weight: bold;
                            {{ $loop->parent->last ? 'border-bottom: 1px solid #aaa;' : 'border-bottom: 1px solid #eee;' }}
                        ">
                            {{ $cell }}</x-filament-reports::table.head-cell>
                    @else
                        <x-filament-reports::table.cell
                            style="
                            padding-left: 8px;
                            padding-right: 8px;
                            padding-top: 4px;
                            padding-bottom: 4px;
                            {{ $loop->parent->last ? 'border-bottom: 1px solid #aaa;' : 'border-bottom: 1px solid #eee;' }}
                        ">
                            <span style="
                            font-size: 12px;
                        ">
                                {{ $cell }}
                            </span>
                        </x-filament-reports::table.cell>
                    @endif
                @endforeach
            </x-filament-reports::table.row>
        @endforeach
    </x-filament-reports::table.body>
</x-filament-reports::table.index>
