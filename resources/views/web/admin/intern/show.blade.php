<x-admin-layout>
    <div class="py-4">
        <x-mysoftcare.navigations.breadcrumb class="mb-4" :items="$breadcrumbs" />
        <x-filament::section>
            <x-slot name="heading">
                Maklumat Pelatih
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Nama:</div>
                <div class="text-md font-bold col-span-2">{{ $record->name }}</div>
                <div class="text-md">IC:</div>
                <div class="text-md font-bold col-span-2">{{ $record->ic }}</div>
                <div class="text-md">E-mel:</div>
                <div class="text-md font-bold col-span-2">{{ $record->email }}</div>
            </div>
        </x-filament::section>
        <br>

        <x-filament::section>
            <x-slot name="heading">
                Maklumat Pengajian
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Tahap Pengajian:</div>
                <div class="text-md font-bold col-span-2">{{ $record->education_level }}</div>
                <div class="text-md">Sekolah/Universiti:</div>
                <div class="text-md font-bold col-span-2">{{ $record->education_institution }}</div>
                <div class="text-md">Tahun Akademik:</div>
                <div class="text-md font-bold col-span-2">{{ $record->year }}</div>
                <div class="text-md">Kemahiran:</div>
                <div class="text-md font-bold col-span-2">{{ $record->skill }}</div>
            </div>
        </x-filament::section>
        <br>

        <x-filament::section>
            <x-slot name="heading">
                Maklumat Latihan Industri
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Tarikh Mula Latihan:</div>
                <div class="text-md font-bold col-span-2">{{ $record->start_date->format('d/m/Y') }}</div>
                <div class="text-md">Tarikh Tamat Latihan:</div>
                <div class="text-md font-bold col-span-2">{{ $record->end_date->format('d/m/Y') }}</div>
                <div class="text-md:">Tempoh Latihan:</div>
                <div class="text-md font-bold col-span-2">{{ $record->internship_period }} bulan</div>
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
        <br>
    </div>
</x-admin-layout>
