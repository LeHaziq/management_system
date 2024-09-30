<?php

namespace App\Livewire\Admin\Project;

use App\Livewire\BaseDataTable;
use App\Models\ProjectAssignment;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;

class AssignmentTable extends BaseDataTable
{
    public $project_id;

    public function mount($project_id = null)
    {
        $this->project_id = $project_id;
    }

    public function getQuery()
    {
        $query = ProjectAssignment::query();

        if ($this->project_id) {
            $query->where('project_id', $this->project_id);
        }

        return $query->latest();
    }

    public function getColumns()
    {
        $columns = [
            TextColumn::make('user.name')
                ->label('Nama'),
            TextColumn::make('role')
                ->label('Tugas')
        ];

        return $columns;
    }

    public function table(Table $table): Table
    {
        $table = $table
            ->heading('Senarai Petugas')
            ->description('Kemaskini maklumat petugas di sini')
            ->emptyStateHeading('Tiada rekod petugas bagi projek ini')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Petugas')
                    ->icon('heroicon-s-plus')
                    ->modalHeading('Tambah Petugas')
                    ->slideOver()
                    ->form(function () {
                        $fields = [
                            Select::make('user_id')
                                ->label('Petugas')
                                ->options(User::pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                            TextInput::make('role')
                                ->label('Tugas'),
                        ];

                        return $fields;
                    })
                    ->action(function (array $data) {
                        $data['project_id'] = $this->project_id ?? $data['project_id'];
                        ProjectAssignment::create($data);
                    })
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->actions([
                DeleteAction::make('delete')
                    ->label('Padam')
                    ->icon(false)
                    ->requiresConfirmation()
                    ->action(fn(ProjectAssignment $record) => $record->delete())
                    ->modalHeading('Padam Petugas')
                    ->modalDescription('Adakah anda pasti ingin melakukan ini?')
                    ->modalCancelActionLabel('Tidak')
                    ->modalSubmitActionLabel('Ya'),
            ])
            ->bulkActions([
                // ...
            ]);

        return $table;
    }
}
