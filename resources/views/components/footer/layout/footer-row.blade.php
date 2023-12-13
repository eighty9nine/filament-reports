<table style="width:100%">
    <tr>
        @foreach ($getChildComponents() as $reportComponent)
            <td>
                {{ $reportComponent }}
            </td>
        @endforeach
    </tr>
</table>
