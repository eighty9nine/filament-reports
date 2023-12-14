<x-filament-panels::page>
    <div class="flex flex-row-reverse gap-8">
        {{ $this->actionsPanel}}
        <x-filament-reports::table.index
            id="fi-report"
            style="
            max-width:100%;
            min-width:75%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid whitesmoke;
            ">
            @foreach ($this->sections as $section)
                <x-filament-reports::table.row>
                    <x-filament-reports::table.cell
                        class="pad"
                        style="{{ $section == 'pad'
                            ? 'padding-top:48px;'
                            : 'padding-left:48px; padding-right:48px;  padding-top: 20px; vertical-align: top;' }}">
                        @if ($section != 'pad')
                            {{ $this->$section }}
                        @endif
                    </x-filament-reports::table.cell>
                </x-filament-reports::table.row>
            @endforeach
        </x-filament-reports::table.index>
    </div>
</x-filament-panels::page>
