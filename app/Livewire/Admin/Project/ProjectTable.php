<?php

namespace App\Livewire\Admin\Project;

use App\Livewire\BaseDataTable;
use App\Models\Project;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProjectTable extends BaseDataTable
{
    public function getQuery()
    {
        return Project::query()->latest();
    }

    public function getColumns()
    {
        $title = TextColumn::make('title')
            ->label('Nama projek')
            ->searchable();
        $agency = TextColumn::make('agency.name')
            ->label('Agensi')
            ->searchable()
            ->sortable();
        $start_date = TextColumn::make('start_date')
            ->label('Tarikh Mula Kontrak')
            ->sortable()
            ->formatStateUsing(fn($state) => $state->format('d/m/Y'));
        $end_date = TextColumn::make('end_date')
            ->label('Tarikh Tamat Kontrak')
            ->sortable()
            ->formatStateUsing(fn($state) => $state->format('d/m/Y'));
        $price = TextColumn::make('price')
            ->label('Nilai Kontrak')
            ->numeric()
            ->money('myr')
            ->sortable()
            ->toggleable();
        $status = TextColumn::make('status')
            ->badge()
            ->color(fn(string $state): string => match ($state) {
                'Berjaya' => 'success',
                'Aktif' => 'primary',
                'EOT' => 'danger',
                'Tempoh jaminan' => 'warning',
                'Selesai' => 'success',
            });
        return [
            $title,
            $agency,
            $start_date,
            $end_date,
            $price,
            $status
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Senarai Projek')
            ->description('Kemaskini maklumat projek di sini')
            ->emptyStateHeading('Tiada rekod projek')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Projek')
                    ->icon('heroicon-s-plus')
                    ->url(fn(): string => route('admin.project.create'))
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Berjaya' => 'Berjaya',
                        'Aktif' => 'Aktif',
                        'EOT' => 'EOT',
                        'Tempoh jaminan' => 'Tempoh jaminan',
                        'Selesai' => 'Selesai',
                    ])
                    ->native(false),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon(false)
                    ->url(fn(Project $record): string => route('admin.project.show', $record->id)),
                ActionGroup::make([
                    EditAction::make()
                        ->label('Kemaskini')
                        ->icon(false)
                        ->url(fn(Project $record): string => route('admin.project.edit', $record->id)),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(Project $record) => $record->delete())
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
