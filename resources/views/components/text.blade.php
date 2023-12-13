@php
    $text = $getText();
    $fontSize = $getFontSize();
    $fontWeight = $getFontWeight();
@endphp
<span style="
        {{ $fontSize->value }}
        {{ $fontWeight->value }}
    ">
    {{ $text }}
</span>
