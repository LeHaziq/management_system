<div class="py-4">
    <div class="font-bold text-xl">Projek: {{ $record->project->title }}</div>
    <div class="text-slate-500">Tahun {{ $record->project->start_date->format('Y') }}</div>
    <br>
    <div class="grid grid-cols-3 gap-2 justify-items-start">
        <div class="text-md">Perbatuan:</div>
        <div class="text-md font-bold col-span-2">{{ $record->title }}</div>
        <div class="text-md">Penerangan:</div>
        <div class="text-md font-bold col-span-2">{{ $record->description }}</div>
        <div class="text-md">Tarikh Mula Perbatuan:</div>
        <div class="text-md font-bold col-span-2">{{ $record->start_date->format('d/m/Y') }}</div>
        <div class="text-md">Tarikh Tamat Perbatuan:</div>
        <div class="text-md font-bold col-span-2">{{ $record->end_date->format('d/m/Y') }}</div>
        <div class="text-md">Progress:</div>
        <div class="text-md font-bold col-span-2">{{ $record->progress }}</div>
    </div>
</div>
