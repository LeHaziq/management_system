<?php

namespace App\Livewire\Admin\Industry;

use App\Livewire\BaseDataTable;
use App\Models\Intern;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;

class InternTable extends BaseDataTable
{
    public function getQuery()
    {
        return Intern::query()->latest();
    }

    public function getColumns()
    {
        $columns = [
            TextColumn::make('name')
                ->label('Nama')
                ->searchable(),
            TextColumn::make('email')
                ->label('E-mel')
                ->searchable(),
        ];

        return $columns;
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Senarai Pelatih Industri')
            ->description('Kemaskini maklumat pelatih di sini')
            ->emptyStateHeading('Tiada rekod pelatih')
            ->emptyStateDescription('Sila tambah pelatih terlebih dahulu')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Pelatih')
                    ->icon('heroicon-s-plus')
                    ->url(fn(): string => route('admin.intern.create'))
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([])
            ->actions([])
            ->bulkActions([
                // ...
            ]);
    }
}
