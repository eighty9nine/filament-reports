<x-filament-panels::page>
    <div class="flex flex-row-reverse gap-8">
        {{ $this->actionsPanel}}
        <x-filament-reports::table.
            class="bg-white dark:bg-gray-900 border-gray-100 dark:border-gray-900"
            id="fi-report"
            style="
            max-width:100%;
            min-width:75%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
