<div>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-button class="mt-4" type="submit">
                Simpan
            </x-button>

        </div>

    </form>

    <x-filament-actions::modals />
</div>

