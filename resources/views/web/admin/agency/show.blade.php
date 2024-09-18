<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengurusan Projek') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <x-mysoftcare.navigations.breadcrumb class="mb-4" :items="$breadcrumbs" />
        <x-filament::section collapsible>
            <x-slot name="heading">
                Maklumat Agensi
            </x-slot>
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Agensi:</div>
                <div class="text-md font-bold col-span-2">{{ $record->name }}</div>
                <div class="text-md">Telefon:</div>
                <div class="text-md font-bold col-span-2">{{ $record->phone }}</div>
                <div class="text-md">E-mel:</div>
                <div class="text-md font-bold col-span-2">{{ $record->email }}</div>
            </div>
        </x-filament::section>
        <br>
        <x-filament::section collapsible>

            <x-slot name="heading">
                Alamat Agensi
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Alamat:</div>
                <div class="text-md font-bold col-span-2">{{ $record->address_1 }}</div>
                <div class="text-md"></div>
                <div class="text-md font-bold col-span-2">{{ $record->address_2 }}</div>
                <div class="text-md"></div>
                <div class="text-md font-bold col-span-2">{{ $record->address_3 }}</div>
                <div class="text-md">Negeri:</div>
                <div class="text-md font-bold col-span-2">{{ $record->district->state->name }}</div>
                <div class="text-md">Daerah:</div>
                <div class="text-md font-bold col-span-2">{{ $record->district->name }}</div>
                <div class="text-md">Postcode:</div>
                <div class="text-md font-bold col-span-2">{{ $record->postcode }}</div>
                <div class="text-md">Telefon:</div>
                <div class="text-md font-bold col-span-2">{{ $record->phone }}</div>
                <div class="text-md">E-mel:</div>
                <div class="text-md font-bold col-span-2">{{ $record->email }}</div>

            </div>
        </x-filament::section>
        <br>
        <livewire:admin.agency.pic-agency-table />
    </div>
</x-admin-layout>
