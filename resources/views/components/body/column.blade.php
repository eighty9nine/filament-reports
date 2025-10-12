@php
    $state = $getState();
@endphp

<div {{ $attributes }}>
    @if (is_array($state))
        {{ implode(', ', array_map('strval', $state)) }}
    @else
        {{ $state }}
    @endif
</div>
