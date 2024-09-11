<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Projek') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @livewire('admin.project.create-project')
    </div>
</x-admin-layout>

