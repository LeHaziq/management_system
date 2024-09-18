<?php

namespace App\Livewire\Admin\Agency;

use App\Livewire\BaseDataTable;
use App\Models\PICAgency;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;

class PicAgencyTable extends BaseDataTable
{
    public function getQuery()
    {
        return PICAgency::query()->latest();
    }

    public function getColumns()
    {
        $name = TextColumn::make('name')
            ->label('Nama PIC')
            ->searchable();
        $phone = TextColumn::make('phone')
            ->label('Telefon');
        $email = TextColumn::make('email')
            ->label('E-mel');
        $position = TextColumn::make('position')
            ->label('Jawatan');

        return [
            $name,
            $phone,
            $email,
            $position
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Senarai PIC Agensi')
            ->description('Kemaskini maklumat PIC agensi di sini')
            ->emptyStateHeading('Tiada rekod PIC agensi')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Agensi')
                    ->icon('heroicon-s-plus')
                    ->url(fn(): string => route('admin.agency.create'))
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([])
            ->actions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon(false)
                    ->url(fn(PICAgency $record): string => route('admin.agency.show', $record->id)),
                ActionGroup::make([
                    EditAction::make()
                        ->label('Kemaskini')
                        ->icon(false)
                        ->url(fn(PICAgency $record): string => route('admin.agency.edit', $record->id)),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(PICAgency $record) => $record->delete())
                        ->modalHeading('Padam Projek')
                        ->modalDescription('Adakah anda pasti ingin melakukan ini?')
                        ->modalCancelActionLabel('Tidak')
                        ->modalSubmitActionLabel('Ya'),
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
