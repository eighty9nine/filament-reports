<table style="width:100%">
    <tr>
        @foreach ($getChildComponents() as $reportComponent)
            <td style="vertical-align: top;">
                {{ $reportComponent }}
            </td>
        @endforeach
    </tr>
</table>
