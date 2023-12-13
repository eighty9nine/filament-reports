@php
    use EightyNine\Reports\Enums\VerticalAlignment;
    use EightyNine\Reports\Enums\HorizontalAlignment;

    $verticalAlignment = match ($getVerticalAlignment()) {
        VerticalAlignment::Top => 'vertical-align:top;',
        VerticalAlignment::Middle => 'vertical-align:middle;',
        VerticalAlignment::Bottom => 'vertical-align:bottom;',
    };

    $horizontalAlignment = match ($getHorizontalAlignment()) {
        HorizontalAlignment::Right => 'text-align:right;',
        HorizontalAlignment::Left => 'text-align:left;',
        HorizontalAlignment::Center => 'text-align:center;',
    };
@endphp
<table style="width:100%;">
    @foreach ($getChildComponents() as $reportComponent)
        <tr>
            <td style="
            {{ $horizontalAlignment }}}
            {{ $verticalAlignment }}}
            ">
                {{ $reportComponent }}
            </td>
        </tr>
    @endforeach
</table>
