<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengurusan Projek') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <x-mysoftcare.navigations.breadcrumb class="mb-4" :items="$breadcrumbs" />
        <livewire:admin.project.project-table />
    </div>
</x-admin-layout>
