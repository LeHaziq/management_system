<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Projek') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <h2 class="font-semibold text-2xl pt-6">
            Selamat datang, {{ Auth::user()->name }}.
        </h2>
        @livewire('admin.project.create-project')
    </div>
</x-admin-layout>

