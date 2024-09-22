<div class="p-4">
    <div class="grid grid-cols-3 gap-2 justify-items-start">
        <div class="text-md">Nama PIC:</div>
        <div class="text-md font-bold col-span-2">{{ $record->name }}</div>
        <div class="text-md">Agensi:</div>
        <div class="text-md font-bold col-span-2">{{ $record->agency->name }}</div>
        <div class="text-md">Telefon</div>
        <div class="text-md font-bold col-span-2">{{ $record->phone }}</div>
        <div class="text-md">E-mel</div>
        <div class="text-md font-bold col-span-2">{{ $record->email }}</div>
        <div class="text-md">Jawatan</div>
        <div class="text-md font-bold col-span-2">{{ $record->position }}</div>
    </div>
</div>
