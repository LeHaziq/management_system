<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengurusan Projek') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <h2 class="font-semibold text-2xl mb-4">
            Selamat datang, {{ Auth::user()->name }}.
        </h2>
        @livewire('admin.project.list-project')
    </div>
</x-admin-layout>
