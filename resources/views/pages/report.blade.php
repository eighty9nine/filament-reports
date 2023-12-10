@php

@endphp
<x-filament-panels::page>
<div class="w-full bg-white shadow-md dark:bg-gray-900 min-h-[600px] p-12">
    {{-- heading section --}}
    <div class="flex flex-row items-center">
        <div class="flex flex-col flex-grow gap-3">
            <p class="text-3xl font-extrabold text-primary-500">{{$heading}}</p>
            <div>
                <p class="opacity-70 text-sm">{{$subHeading}}</p>
                <p class="opacity-70 text-sm">{{now()->toString()}}</p>
            </div>
        </div>
    </div>

    {{-- body section --}}

    {{-- footer section --}}
</div>
</x-filament-panels::page>
