<?php

namespace App\Livewire\Admin\Project;

use App\Livewire\BaseForm;
use App\Models\Agency;
use App\Models\District;
use App\Models\Project;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;

class ProjectForm extends BaseForm
{

    public ?Project $project = null;

    public function mount(): void
    {
        $this->project ??= new Project();
        $this->data = $this->project->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Basic Information
                Section::make('Maklumat Projek')
                    ->description('Maklumat mengenai projek')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Nama projek'),
                        Select::make('agency_id')
                            ->required()
                            ->label('Agensi')
                            ->placeholder('Pilih Agensi')
                            ->options(Agency::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->createOptionForm([
                                TextInput::make('name')->required()->label('Nama Agensi'),
                                TextInput::make('address_1')->required()->label('Alamat 1'),
                                TextInput::make('address_2')->label('Alamat 2'),
                                TextInput::make('address_3')->label('Alamat 3'),
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
                                TextInput::make('email')->required()->email()->label('E-mel'),
                            ])
                            ->createOptionUsing(function (array $data) {
                                $agency = Agency::create($data);

                                Notification::make()
                                    ->title('Success')
                                    ->body('Agency created successfully')
                                    ->success()
                                    ->send();

                                return $agency->id;
                            }),
                        TextInput::make('pic_agency')
                            ->required()
                            ->label('PIC Agensi'),
                    ]),

                // Contract Details
                Section::make('Maklumat Kontrak')
                    ->schema([
                        TextInput::make('contract_period')
                            ->required()
                            ->integer()
                            ->label('Tempoh Kontrak')
                            ->helperText('Bulan'),
                        TextInput::make('warranty_period')
                            ->required()
                            ->integer()
                            ->label('Tempoh Jaminan')
                            ->helperText('Bulan'),
                        DatePicker::make('start_date')
                            ->required()
                            ->label('Tarikh Mula Kontrak')
                            ->native(false)
                            ->placeholder('dd/mm/yyyy')
                            ->suffixIcon('heroicon-s-calendar'),
                        DatePicker::make('end_date')
                            ->required()
                            ->label('Tarikh Tamat Kontrak')
                            ->native(false)
                            ->placeholder('dd/mm/yyyy')
                            ->suffixIcon('heroicon-s-calendar'),
                    ]),

                // Financial Information
                Section::make('Maklumat Kewangan')
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('RM')
                            ->label('Harga Kontrak'),
                        FileUpload::make('SST_file')
                            ->label('SST File'),
                    ]),

                // Additional Information
                Section::make('Maklumat Tambahan')
                    ->schema([
                        Textarea::make('notes')
                            ->required()
                            ->columnSpan('full')
                            ->label('Catatan'),
                        TextInput::make('creator')
                            ->required()
                            ->label('Pencipta'),
                        Select::make('status')
                            ->required()
                            ->options([
                                'Berjaya' => 'Berjaya',
                                'Aktif' => 'Aktif',
                                'EOT' => 'EOT',
                                'Tempoh jaminan' => 'Tempoh jaminan',
                                'Selesai' => 'Selesai',
                            ])
                            ->native(false)
                            ->searchable()
                            ->placeholder('Pilih status projek')
                            ->helperText('Status projek terkini')
                    ]),
            ])
            ->statePath('data')->inlineLabel();
    }

    public function save()
    {
        $this->form->getState();
        $this->project->fill([
            ...$this->data,
        ])->save();

        // if ($this->form->validate()) {
        //     if (!$this->project->exists) {
        //         Project::create($this->form->getState());
        //     } else {
        //         $this->project->fill($this->form->getState())->save();
        //     }

        Notification::make()
            ->title('Berjaya')
            ->body('Maklumat berjaya disimpan')
            ->success()
            ->color('success')
            ->seconds(3)
            ->send();

        return to_route('admin.project.index');
    }
}
