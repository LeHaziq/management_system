<?php

namespace App\Livewire\Admin\Project;

use App\Livewire\BaseDataTable;
use App\Models\ProjectMilestone;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MilestoneTable extends BaseDataTable
{
    public function getQuery()
    {
        return ProjectMilestone::query()->latest();
    }

    public function getColumns()
    {
        $name = TextColumn::make('title')
            ->label('Nama Agensi')
            ->searchable();
        $email = TextColumn::make('description')
            ->label('E-mel');
        $progress = TextColumn::make('progress')
            ->label('Progress');

        return [
            $name,
            $email,
            $progress
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Perbatuan Projek')
            ->emptyStateHeading('Tiada rekod perbatuan')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Perbatuan')
                    ->icon('heroicon-s-plus')
                    ->url(fn(): string => route('admin.project.create'))
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([])
            ->actions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon(false)
                    ->modal()
                    ->modalWidth('w-full')
                    ->slideOver()
                    ->modalHeading('Maklumat Projek')
                    ->modalContent(fn(ProjectMilestone $record): View => view(
                        'web.admin.project.modal.details',
                        ['record' => $record],
                    )),
                ActionGroup::make([
                    EditAction::make()
                        ->label('Kemaskini')
                        ->icon(false)
                        ->url(fn(ProjectMilestone $record): string => route('admin.project.edit', $record->id)),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(ProjectMilestone $record) => $record->delete())
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
