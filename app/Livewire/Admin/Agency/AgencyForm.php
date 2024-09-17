<?php

namespace App\Livewire\Admin\Agency;

use App\Livewire\BaseForm;
use App\Models\Agency;
use App\Models\District;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class AgencyForm extends BaseForm
{
    public ?Agency $agency = null;

    public function mount(): void
    {
        $this->agency ??= new Agency();
        $this->data = $this->agency->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Basic Information
                Section::make('Maklumat Agensi')
                    ->description('Maklumat mengenai agensi')
                    ->schema([
                        TextInput::make('name')->required()->label('Nama Agensi')->columnSpan('full'),
                        TextInput::make('address_1')
                            ->required()
                            ->label('Alamat 1')
                            ->columnSpan('full'),
                        TextInput::make('address_2')->label('Alamat 2')->columnSpan('full'),
                        TextInput::make('address_3')->label('Alamat 3')->columnSpan('full'),
                        Select::make('state_id')
                            ->label('Negeri')
                            ->required()
                            ->options(State::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(callable $set) => $set('district_id', null)),

                        Select::make('district_id')
                            ->label('Daerah')
                            ->required()
                            ->options(function (callable $get) {
                                $stateId = $get('state_id');
                                if (!$stateId) {
                                    return [];
                                }
                                return District::where('state_id', $stateId)
                                    ->orderBy('name')
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->disabled(fn(callable $get) => !$get('state_id')),
                        TextInput::make('postcode')->required(),
                        TextInput::make('phone')->required()->tel()->label('Telefon'),
                        TextInput::make('email')->required()->email()->label('E-mel')->columnSpan(2),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $this->form->getState();

        $this->agency->fill([
            ...$this->data,
        ])->save();

        Notification::make()
            ->title('Berjaya')
            ->body('Maklumat berjaya disimpan')
            ->success()
            ->color('success')
            ->seconds(3)
            ->send();

        return to_route('admin.agency.index');
    }
}
