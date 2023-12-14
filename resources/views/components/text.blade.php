@php
    $text = $getText();
    $fontSize = $getFontSize();
    $fontWeight = $getFontWeight();
    $color = \Filament\Support\get_color_css_variables($getColor(), shades: [400, 600], alias: 'reports::components.text');
@endphp
<span style="
        {{ $fontSize->value }}
        {{ $fontWeight->value }}
        {{ $color }}
    "
    @class([
        match ($color) {
            null => 'text-gray-950 dark:text-white',
            'gray' => 'text-gray-500 dark:text-gray-400',
            default => 'text-custom-600 dark:text-custom-400',
        },
    ])">
    {{ $text }}
</span>
