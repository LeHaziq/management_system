<?php

namespace App\Livewire\Admin\Industry;

use App\Livewire\BaseDataTable;
use App\Models\Intern;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
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
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit')
                        ->label('Kemaskini')
                        ->icon(false)
                        ->url(fn(Intern $record): string => route('admin.intern.edit', $record->id)),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(Intern $record) => $record->delete())
                        ->modalHeading('Padam Projek')
                        ->modalDescription('Adakah anda pasti ingin melakukan ini?')
                        ->modalCancelActionLabel('Tidak')
                        ->modalSubmitActionLabel('Ya'),
                ]),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
