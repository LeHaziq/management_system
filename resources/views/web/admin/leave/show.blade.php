<x-admin-layout>
    <div class="py-4">
        <x-mysoftcare.navigations.breadcrumb class="mb-4" :items="$breadcrumbs" />
        <x-filament::section>
            <x-slot name="heading">
                Maklumat Permohon
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Nama:</div>
                <div class="text-md font-bold col-span-2">{{ $record->intern->name }}</div>
                <div class="text-md">IC:</div>
                <div class="text-md font-bold col-span-2">{{ $record->intern->ic }}</div>
                <div class="text-md">E-mel:</div>
                <div class="text-md font-bold col-span-2">{{ $record->intern->email }}</div>
            </div>
        </x-filament::section>
        <br>

        <x-filament::section>
            <x-slot name="heading">
                Permohonan Cuti
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Alasan:</div>
                <div class="text-md font-bold col-span-2">{{ $record->reason }}</div>
                <div class="text-md">Tarikh Mula Cuti:</div>
                <div class="text-md font-bold col-span-2">{{ $record->start_date->format('d/m/Y') }}</div>
                <div class="text-md">Tarikh Tamat Cuti:</div>
                <div class="text-md font-bold col-span-2">{{ $record->end_date->format('d/m/Y') }}</div>
                <div class="text-md">Tempoh Cuti:</div>
                <div class="text-md font-bold col-span-2">{{ $record->leave_duration }} hari</div>
            </div>
        </x-filament::section>
        <br>
        <x-filament::section>
            <x-slot name="heading">
                Status
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Status:</div>
                @php
                $statusColor = match ($record->status) {
                'Diterima' => 'success',
                'Aktif' => 'primary',
                'Ditolak' => 'danger',
                'Tamat' => 'warning',
                default => 'secondary',
                };
                @endphp

                <x-filament::badge color="{{ $statusColor }}" size="xl">
                    {{ $record->status }}
                </x-filament::badge>
            </div>
        </x-filament::section>
    </div>
</x-admin-layout>
