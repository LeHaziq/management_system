<x-filament::section collapsible>
    <x-slot name="heading">
        User details
    </x-slot>

    {{-- Content --}}
    <x-filament::badge>
        {{ $record->status }}
    </x-filament::badge>

    {{ $record->title }}
    {{ $record->agency }}
    {{ $record->pic_agency }}
    {{ $record->contract_period }}
    {{ $record->warranty_period }}
    {{ $record->start_date }}
    {{ $record->end_date }}
    {{ $record->price }}
    {{ $record->SST_file }}
    {{ $record->notes }}
    {{ $record->creator }}
</x-filament::section>
