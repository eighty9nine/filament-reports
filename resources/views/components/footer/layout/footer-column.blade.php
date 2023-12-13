<table style="width:100%">
    @foreach ($getChildComponents() as $reportComponent)
        <tr>
            <td>
                {{ $reportComponent }}
            </td>
        </tr>
    @endforeach
</table>
