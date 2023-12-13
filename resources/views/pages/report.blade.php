@php

@endphp
<x-filament-panels::page>
    <table
        style="
        width:80%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    ">
        <tr>
            <td style="padding-top:48px;">
            </td>
        <tr>
            <td style="padding-left:48px; padding-right:48px;">
                {{-- heading section --}}
                {{ $this->header }}
            </td>
        </tr>
        <tr>
            <td style="padding-left:48px; padding-right:48px;">
                {{-- body section --}}
                {{ $this->body }}
            </td>
        </tr>
        <tr>
            <td style="padding-left:48px; padding-right:48px;">
                {{-- footer section --}}
                {{ $this->footer }}
            </td>
        </tr>
        <tr>
            <td style="padding-top:48px;">
            </td>
        <tr>
    </table>
</x-filament-panels::page>
