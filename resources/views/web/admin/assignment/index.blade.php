<x-admin-layout>
    <div class="py-4">
        <x-mysoftcare.navigations.breadcrumb class="mb-4" :items="$breadcrumbs" />
        <x-mysoftcare.navigations.tab class="mb-4">
            <x-mysoftcare.navigations.tab-link href="{{ route('admin.project.show', $record->id) }}" class="rounded-s-lg" :active="request()->routeIs('admin.project.show')">
                Maklumat Projek
            </x-mysoftcare.navigations.tab-link>
            <x-mysoftcare.navigations.tab-link href="{{ route('admin.assignment.index', $record->id) }}" class="rounded-e-lg" :active="request()->routeIs('admin.assignment.index')">
                Penugasan Projek
            </x-mysoftcare.navigations.tab-link>
        </x-mysoftcare.navigations.tab>
        <div class="font-bold text-xl">{{ $record->title }}</div>
        <div class="text-slate-500">Tahun {{ $record->start_date->format('Y') }}</div>
        <br>
        <livewire:admin.project.assignment-table :project_id="$record->id" />
    </div>
</x-admin-layout>
