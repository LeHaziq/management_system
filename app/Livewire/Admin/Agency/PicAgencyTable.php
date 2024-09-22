<?php

namespace App\Livewire\Admin\Agency;

use App\Livewire\BaseDataTable;
use App\Models\PICAgency;
use App\Models\Agency;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;

class PicAgencyTable extends BaseDataTable
{
    public $agency_id;

    public function mount($agency_id = null)
    {
        $this->agency_id = $agency_id;
    }

    public function getQuery()
    {
        $query = PICAgency::query();

        if ($this->agency_id) {
            $query->where('agency_id', $this->agency_id);
        }

        return $query->latest();
    }

    public function getColumns()
    {
        $columns = [
            TextColumn::make('name')
                ->label('Nama PIC')
                ->searchable(),
            TextColumn::make('phone')
                ->label('Telefon'),
            TextColumn::make('email')
                ->label('E-mel'),
            TextColumn::make('position')
                ->label('Jawatan'),
        ];

        if (!$this->agency_id) {
            $columns[] = TextColumn::make('agency.name')
                ->label('Agensi')
                ->searchable();
        }

        return $columns;
    }

    public function table(Table $table): Table
    {
        $table = $table
            ->heading($this->agency_id ? 'Senarai PIC Agensi' : 'Senarai Semua PIC Agensi')
            ->description('Kemaskini maklumat PIC agensi di sini')
            ->emptyStateHeading('Tiada rekod PIC agensi')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah PIC')
                    ->icon('heroicon-s-plus')
                    ->modalHeading('Tambah PIC Agensi')
                    ->slideOver()
                    ->form(function () {
                        $fields = [
                            TextInput::make('name')
                                ->label('Nama PIC')
                                ->required(),
                            TextInput::make('phone')
                                ->label('Telefon')
                                ->required(),
                            TextInput::make('email')
                                ->label('E-mel')
                                ->email()
                                ->required(),
                            TextInput::make('position')
                                ->label('Jawatan')
                                ->required(),
                        ];

                        if (!$this->agency_id) {
                            $fields[] = Select::make('agency_id')
                                ->label('Agensi')
                                ->options(Agency::pluck('name', 'id'))
                                ->searchable()
                                ->required();
                        }

                        return $fields;
                    })
                    ->action(function (array $data) {
                        $data['agency_id'] = $this->agency_id ?? $data['agency_id'];
                        PICAgency::create($data);
                    })
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->actions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon(false)
                    ->modalHeading('Maklumat PIC Agensi')
                    ->modalContent(fn(PICAgency $record) => view('web.admin.pic.show', compact('record'))),
                ActionGroup::make([
                    EditAction::make()
                        ->label('Kemaskini')
                        ->icon(false)
                        ->form([
                            TextInput::make('name')
                                ->label('Nama PIC')
                                ->required(),
                            TextInput::make('phone')
                                ->label('Telefon')
                                ->required(),
                            TextInput::make('email')
                                ->label('E-mel')
                                ->email()
                                ->required(),
                            TextInput::make('position')
                                ->label('Jawatan')
                                ->required(),
                            $this->agency_id ? null : Select::make('agency_id')
                                ->label('Agensi')
                                ->options(Agency::pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                        ])
                        ->action(function (PICAgency $record, array $data) {
                            $record->update($data);
                        }),
                    DeleteAction::make('delete')
                        ->label('Padam')
                        ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(PICAgency $record) => $record->delete())
                        ->modalHeading('Padam PIC')
                        ->modalDescription('Adakah anda pasti ingin melakukan ini?')
                        ->modalCancelActionLabel('Tidak')
                        ->modalSubmitActionLabel('Ya'),
                ])
            ])
            ->bulkActions([
                // ...
            ]);

        if (!$this->agency_id) {
            $table->filters([
                SelectFilter::make('agency_id')
                    ->label('Agensi')
                    ->options(Agency::pluck('name', 'id'))
                    ->searchable()
            ]);
        }

        return $table;
    }
}
