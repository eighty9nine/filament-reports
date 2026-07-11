@php
    $state = $formatState($getState());
    $isBadge = $isBadge();
    $isBulleted = $isBulleted();
    $isListWithLineBreaks = $isListWithLineBreaks();
    $listLimit = $getListLimit();
    $canWrap = $canWrap();
@endphp

<div {{ $attributes->class(['fi-ta-text-column']) }}>
    @if (is_array($state))
        @if ($isBulleted || $isListWithLineBreaks)
            <ul class="{{ $isBulleted ? 'list-disc list-inside' : '' }}">
                @foreach (array_slice($state, 0, $listLimit ?? count($state)) as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            @if ($listLimit && count($state) > $listLimit)
                <span class="text-sm text-gray-500">
                    {{ trans_choice('filament-tables::table.columns.text.more_list_items', count($state) - $listLimit) }}
                </span>
            @endif
        @else
            {{ implode(', ', $listLimit ? array_slice($state, 0, $listLimit) : $state) }}
            @if ($listLimit && count($state) > $listLimit)
                <span class="text-sm text-gray-500">
                    +{{ count($state) - $listLimit }}
                </span>
            @endif
        @endif
    @else
        <span class="{{ $canWrap ? '' : 'truncate' }}">
            @if ($isBadge)
                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md">
                    {{ $state }}
                </span>
            @else
                {{ $state }}
            @endif
        </span>
    @endif
</div>
