<?php

namespace App\Livewire\Admin\Agency;

use App\Livewire\BaseDataTable;
use App\Models\Agency;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AgencyTable extends BaseDataTable
{
    public function getQuery()
    {
        return Agency::query()->latest();
    }

    public function getColumns()
    {
        $name = TextColumn::make('name')
            ->label('Nama Agensi')
            ->searchable();
        $email = TextColumn::make('email')
            ->label('E-mel');
        $phone = TextColumn::make('phone')
            ->label('Telefon');

        return [
            $name,
            $email,
            $phone
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Senarai Agensi')
            ->description('Kemaskini maklumat agensi di sini')
            ->emptyStateHeading('Tiada rekod agensi')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Agensi')
                    ->icon('heroicon-s-plus')
                    ->url(fn(): string => route('admin.agency.create'))
                    ->color('info')
            ])
            ->query($this->getQuery())
            ->columns($this->getColumns())
            ->filters([

            ])
            ->actions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon(false)
                    ->modal()
                    ->modalWidth('w-full')
                    ->slideOver()
                    ->modalHeading('Maklumat Projek')
                    ->modalContent(fn(Agency $record): View => view(
                        'web.admin.project.modal.details',
                        ['record' => $record],
                    )),
                ActionGroup::make([
                    EditAction::make()
                        ->label('Kemaskini')
                        ->icon(false)
                        ->url(fn(Agency $record): string => route('admin.agency.edit', $record->id)),
                    DeleteAction::make('delete')
                    ->label('Padam')
                    ->icon(false)
                        ->requiresConfirmation()
                        ->action(fn(Agency $record) => $record->delete())
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
