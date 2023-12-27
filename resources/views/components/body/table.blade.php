@php
    $data = $getData();
    $hasHeadings = $hasHeadings();
    $headings = $getHeadings();
    $isFirstColumnUsedAsHeadings = $isFirstColumnUsedAsHeadings();
    $columns = $getColumns();
    $hasColumns = $hasColumns();
    $hasSummary = $hasSummary();
@endphp
<x-filament-reports::table.index class="border-t-4 border-primary-500"
                                 style="width: 100%;
border-bottom: 1px solid rgb(210, 210, 210);">

    <x-filament-reports::table.head>
        @if ($hasHeadings)
            <x-filament-reports::table.row>
                @unless ($hasColumns)
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
                @else
                    @foreach ($columns as $column)
                        @php
                            $alignment = $column->getAlignment() ?? \Filament\Support\Enums\Alignment::Start;
                            if (! $alignment instanceof \Filament\Support\Enums\Alignment) {
                                $alignment = filled($alignment) ? (\Filament\Support\Enums\Alignment::tryFrom($alignment) ?? $alignment) : null;
                            }
                            $columnClasses = \Illuminate\Support\Arr::toCssClasses([
                                match ($alignment) {
                                    \Filament\Support\Enums\Alignment::Start => 'justify-start text-start',
                                    \Filament\Support\Enums\Alignment::Center => 'justify-center text-center',
                                    \Filament\Support\Enums\Alignment::End => 'justify-end text-end',
                                    \Filament\Support\Enums\Alignment::Left => 'justify-start text-left',
                                    \Filament\Support\Enums\Alignment::Right => 'justify-end text-right',
                                    \Filament\Support\Enums\Alignment::Justify => 'justify-between text-justify',
                                    default => $alignment,
                                },
                            ]);
                        @endphp
                        <x-filament-reports::table.head-cell
                            class="{{ $columnClasses }}"
                            style="
                                    padding-left: 8px;
                                    padding-right: 8px;
                                    padding-top: 4px;
                                    padding-bottom: 4px;
                                    border-bottom: 1px solid #aaa;
                                    border-top: 1px solid #aaa;
                                    font-weight: bold;
                                ">
                            {{ str($column->getLabel())->title() }}</x-filament-reports::table.head-cell>
                    @endforeach
                @endunless

            </x-filament-reports::table.row>
        @endif
    </x-filament-reports::table.head>
    <x-filament-reports::table.body>
        @foreach ($data as $row)
            <x-filament-reports::table.row>
                @foreach ($row as $key => $cell)
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
                    @elseif($hasColumns)
                        {{-- @foreach ($columns as $recordKey => $column) --}}
                        @php
                            $column = $getColumnByName($key);
                            $column->record($row);
                            $column->rowLoop($loop->parent);
                        @endphp
                        <x-filament-reports::table.cell
                            style="
                                padding-left: 8px;
                                padding-right: 8px;
                                padding-top: 4px;
                                padding-bottom: 4px;
                                {{ $loop->parent->last ? 'border-bottom: 1px solid #aaa;' : 'border-bottom: 1px solid #eee;' }}
                                ">
                            <x-filament-tables::columns.column :column="$column"
                                                               :is-click-disabled="$column->isClickDisabled()"
                                                               :record="$row"
                                                               :record-key="$loop->iteration" />
                        </x-filament-reports::table.cell>
                        {{-- @endforeach --}}
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
    @if($hasSummary)
        <x-filament-reports::table.foot>
            <x-filament-reports::table.row>
                @foreach($columns as $column)

                    @php

                        $alignment = $column->getAlignment() ?? \Filament\Support\Enums\Alignment::Start;
                        if (! $alignment instanceof \Filament\Support\Enums\Alignment) {
                            $alignment = filled($alignment) ? (\Filament\Support\Enums\Alignment::tryFrom($alignment) ?? $alignment) : null;
                        }
                        $columnClasses = \Illuminate\Support\Arr::toCssClasses([
                            match ($alignment) {
                                \Filament\Support\Enums\Alignment::Start => 'justify-start text-start',
                                \Filament\Support\Enums\Alignment::Center => 'justify-center text-center',
                                \Filament\Support\Enums\Alignment::End => 'justify-end text-end',
                                \Filament\Support\Enums\Alignment::Left => 'justify-start text-left',
                                \Filament\Support\Enums\Alignment::Right => 'justify-end text-right',
                                \Filament\Support\Enums\Alignment::Justify => 'justify-between text-justify',
                                default => $alignment,
                            },
                        ]);
                    @endphp
                    @if($column->hasSum())
                        <x-filament-reports::table.cell
                            class="{{ $columnClasses }}"
                            style="
                                padding-left: 8px;
                                padding-right: 8px;
                                padding-top: 4px;
                                padding-bottom: 4px;
                                border-bottom: 1px solid #aaa;
                                border-top: 1px solid #aaa;
                                font-weight: bold;">
                            <span style="
                            font-size: 12px;
                        ">
                            {{ $column->formatState($data->sum($column->getName())) }}
                            </span>
                        </x-filament-reports::table.cell>
                    @else
                        <x-filament-reports::table.cell>
                        </x-filament-reports::table.cell>
                    @endif
                @endforeach
            </x-filament-reports::table.row>
        </x-filament-reports::table.foot>
    @endif
</x-filament-reports::table.index>
