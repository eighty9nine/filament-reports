@php
    $path = $getPath();
    $width = $getWidth();
@endphp
<img src="{{ $path }}" alt="" style="{{ $width->value }}">
