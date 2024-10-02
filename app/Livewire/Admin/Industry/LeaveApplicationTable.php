<?php

namespace App\Livewire\Admin\Industry;

use App\Livewire\BaseDataTable;
use Livewire\Component;
use App\Models\LeaveApplication;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeaveApplicationTable extends BaseDataTable
{
    public function getQuery()
    {
        return LeaveApplication::query()->latest();
    }

    public function getColumns()
    {
        $columns = [
            TextColumn::make('intern.name')
                ->label('Nama')
                ->searchable(),
            TextColumn::make('start_date')
                ->label('Tarikh Mula Cuti'),
            TextColumn::make('end_date')
                ->label('Tarikh Tamat Cuti'),
            TextColumn::make('leave_duration')
                ->label('Tempoh Cuti'),
        ];

        return $columns;
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Senarai Permohonan Cuti')
            ->emptyStateHeading('Tiada rekod pemohonan cuti')
            ->emptyStateDescription('')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Permohonan Cuti')
                    ->icon('heroicon-s-plus')
                    ->url(fn(): string => route('admin.intern.create'))
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([])
            ->actions([
                ViewAction::make('show')
                    ->label('Lihat')
                    ->icon('heroicon-s-eye')
                    ->url(fn(LeaveApplication $record): string => route('admin.intern.show', $record->id)),
                ActionGroup::make([
                    EditAction::make('edit')
                        ->label('Kemaskini')
                        ->icon(false)
                        ->url(fn(LeaveApplication $record): string => route('admin.intern.edit', $record->id)),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(LeaveApplication $record) => $record->delete())
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
