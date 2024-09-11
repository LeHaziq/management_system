<div>
    <form wire:submit="create">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-button class="mt-4" type="submit">
                Submit
            </x-button>

        </div>

    </form>

    <x-filament-actions::modals />
</div>
