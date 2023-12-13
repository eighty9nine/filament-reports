@php
    $data = $getData();
    $hasHeadings = $hasHeadings();
    $headings = $getHeadings();
    $isFirstColumnUsedAsHeadings = $isFirstColumnUsedAsHeadings();
@endphp
<table style="width: 100%; border-top: 3px solid black;
border-bottom: 1px solid rgb(210, 210, 210); margin-top: 20px;">

    <thead>
        @if ($hasHeadings)
            <tr>
                @foreach ($headings as $heading)
                    <th
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
                        {{ $heading }}</th>
                @endforeach
            </tr>
        @endif
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row as $cell)
                    @if ($loop->first && $isFirstColumnUsedAsHeadings)
                        <th
                            style="
                            padding-left: 8px;
                            padding-right: 8px;
                            padding-top: 4px;
                            padding-bottom: 4px;
                            border-bottom: 1px solid #aaa;
                            border-top: 1px solid #aaa;
                            text-align: left;
                            font-weight: bold;
                            @if ($loop->parent->last)
                                border-bottom: 1px solid #aaa;
                            @else
                                border-bottom: 1px solid #eee;
                            @endif
                        ">
                            {{ $cell }}</th>
                    @else
                    <td
                        style="
                            padding-left: 8px;
                            padding-right: 8px;
                            padding-top: 4px;
                            padding-bottom: 4px;
                            @if ($loop->parent->last)
                                border-bottom: 1px solid #aaa;
                            @else
                                border-bottom: 1px solid #eee;
                            @endif
                        ">
                        <span
                            style="
                            font-size: 12px;
                        ">
                            {{ $cell }}
                        </span>
                    </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
