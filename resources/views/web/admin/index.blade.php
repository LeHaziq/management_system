<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire(\App\Livewire\Admin\Project\ProjectOverview::class)
        <livewire:admin.project.project-table />
    </div>
</x-admin-layout>

