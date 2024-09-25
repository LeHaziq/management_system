<?php

namespace App\Livewire\Admin\Project;

use App\Livewire\BaseDataTable;
use App\Models\Project;
use App\Models\ProjectMilestone;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
    public $project_id;

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function getQuery()
    {
        return ProjectMilestone::query()
            ->where('project_id', $this->project_id)
            ->latest();
    }

    public function getColumns()
    {
        $name = TextColumn::make('title')
            ->label('Perbatuan');
        $start_date = TextColumn::make('start_date')
            ->label('Tarikh Mula Perbatuan')
            ->sortable()
            ->formatStateUsing(fn($state) => $state->format('d/m/Y'));
        $end_date = TextColumn::make('end_date')
            ->label('Tarikh Tamat Perbatuan')
            ->sortable()
            ->formatStateUsing(fn($state) => $state->format('d/m/Y'));
        $progress = TextColumn::make('progress')
            ->label('Progress');

        return [
            $name,
            $start_date,
            $end_date,
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
                    ->color('info')
                    ->modalHeading('Tambah Perbatuan Baru')
                    ->slideOver()
                    ->form([
                        TextInput::make('title')
                            ->label('Perbatuan')
                            ->required(),
                        Textarea::make('description')
                            ->label('Penerangan')
                            ->required(),
                        DatePicker::make('start_date')
                            ->label('Tarikh Mula Perbatuan')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Tarikh Tamat Perbatuan')
                            ->required(),
                        TextInput::make('progress')
                            ->label('Progress')
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        ProjectMilestone::create([
                            ...$data,
                            'project_id' => $this->project_id,
                        ]);
                    })
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([])
            ->actions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon(false)
                    ->modal()
                    ->modalHeading('Maklumat Perbatuan')
                    ->modalContent(fn(ProjectMilestone $record): View => view(
                        'web.admin.milestone.show',
                        ['record' => $record],
                    )),
                ActionGroup::make([
                    EditAction::make()
                        ->label('Kemaskini')
                        ->icon(false)
                        ->modalHeading('Kemaskini Perbatuan')
                        ->slideOver()
                        ->form([
                            TextInput::make('title')
                                ->label('Perbatuan')
                                ->required(),
                            Textarea::make('description')
                                ->label('Penerangan')
                                ->required(),
                            DatePicker::make('start_date')
                                ->label('Tarikh Mula Perbatuan')
                                ->required(),
                            DatePicker::make('end_date')
                                ->label('Tarikh Tamat Perbatuan')
                                ->required(),
                            TextInput::make('progress')
                                ->label('Progress')
                                ->required(),
                        ])
                        ->action(function (ProjectMilestone $record, array $data): void {
                            $record->update($data);
                        }),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(ProjectMilestone $record) => $record->delete())
                        ->modalHeading('Padam Perbatuan')
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
