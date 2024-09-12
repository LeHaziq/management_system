<?php

namespace App\Livewire\Admin\Project;

use App\Models\Project;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter as FiltersFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListProject extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

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
            ->query(Project::query()->latest())
            ->columns([
                TextColumn::make('title')
                    ->label('Nama projek')
                    ->searchable(),
                TextColumn::make('agency')
                    ->label('Agensi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Tarikh Mula Kontrak')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state->format('d/m/Y')),
                TextColumn::make('end_date')
                    ->label('Tarikh Tamat Kontrak')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state->format('d/m/Y')),
                TextColumn::make('price')
                    ->label('Nilai Kontrak')
                    ->numeric()
                    ->money('myr')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Berjaya' => 'success',
                        'Aktif' => 'primary',
                        'EOT' => 'danger',
                        'Tempoh jaminan' => 'warning',
                        'Selesai' => 'success',
                    }),
            ])
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
                    ->modal()
                    ->modalWidth('w-full')
                    ->slideOver()
                    ->modalHeading('Lihat Project')
                    ->modalDescription('Lihat detail project')
                    ->modalContent(fn(Project $record): View => view(
                        'web.admin.project.modal.details',
                        ['record' => $record],
                    )),
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

    public function render()
    {
        return view('livewire.admin.project.list-project');
    }
}
