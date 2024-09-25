<x-admin-layout>
    <div class="py-4">
        <x-mysoftcare.navigations.breadcrumb class="mb-4" :items="$breadcrumbs" />
        <x-mysoftcare.navigations.tab class="mb-4">
            <x-mysoftcare.navigations.tab-link href="{{ route('admin.project.show', $record->id) }}" class="rounded-s-lg" :active="request()->routeIs('admin.project.show')">
                Maklumat Projek
            </x-mysoftcare.navigations.tab-link>
            <x-mysoftcare.navigations.tab-link href="{{ route('admin.project.show', $record->id) }}" class="rounded-e-lg">

                Penugasan Projek
            </x-mysoftcare.navigations.tab-link>

        </x-mysoftcare.navigations.tab>
        <div class="font-bold text-xl">{{ $record->title }}</div>
        <div class="text-slate-500">Tahun {{ $record->start_date->format('Y') }}</div>
        <br>

        <x-filament::section>
            <x-slot name="heading">
                Maklumat Agensi
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Agensi:</div>
                <x-mysoftcare.navigations.navbar-sublink href="{{ route('admin.agency.show', $record->agency->id) }}" class=" col-span-2" :active="request()->routeIs('admin.agency.show')">
                    {{ $record->agency->name }}
                </x-mysoftcare.navigations.navbar-sublink>
            </div>
        </x-filament::section>
        <br>

        <x-filament::section>
            <x-slot name="heading">
                Maklumat Kontrak
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Tempoh Kontrak:</div>
                <div class="text-md font-bold col-span-2">{{ $record->contract_period }} bulan</div>
                <div class="text-md">Tempoh Jaminan:</div>
                <div class="text-md font-bold col-span-2">{{ $record->warranty_period }} bulan</div>
                <div class="text-md">Tarikh Mula Kontrak:</div>
                <div class="text-md font-bold col-span-2">{{ $record->start_date->format('d/m/Y') }}</div>

                <div class="text-md">Tarikh Tamat Kontrak:</div>
                <div class="text-md font-bold col-span-2">{{ $record->end_date->format('d/m/Y') }}</div>

                <div class="text-md">Nilai Kontrak:</div>
                <div class="text-md font-bold col-span-2">RM {{ number_format($record->price, 2) }}</div>

                <div class="text-md">SST File:</div>
                <a href="{{ $record->SST_file }}" class="text-md font-bold col-span-2">SST File</a>
            </div>
        </x-filament::section>
        <br>

        <x-filament::section>
            <x-slot name="heading">
                Maklumat Tambahan
            </x-slot>

            {{-- Content --}}
            <div class="grid grid-cols-3 gap-2 justify-items-start">
                <div class="text-md">Catatan:</div>
                <div class="text-md font-bold col-span-2">{{ $record->notes }}</div>
                <div class="text-md">Pencipta:</div>
                <div class="text-md font-bold col-span-2">{{ $record->creator }}</div>
                <div class="text-md">Status:</div>
                @php
                $statusColor = match ($record->status) {
                'Berjaya' => 'success',
                'Aktif' => 'primary',
                'EOT' => 'danger',
                'Tempoh jaminan' => 'warning',
                'Selesai' => 'success',
                default => 'secondary',
                };
                @endphp

                <x-filament::badge color="{{ $statusColor }}" size="xl">
                    {{ $record->status }}
                </x-filament::badge>

            </div>
        </x-filament::section>
        <br>
        <livewire:admin.project.milestone-table :project_id="$record->id" />
    </div>
</x-admin-layout>
