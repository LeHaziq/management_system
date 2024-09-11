<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengurusan Projek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('admin.project.list-project')
    </div>
</x-admin-layout>
