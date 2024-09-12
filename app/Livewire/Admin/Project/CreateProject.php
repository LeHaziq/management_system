<?php

namespace App\Livewire\Admin\Project;

use App\Models\Project;
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
use Filament\Notifications\Notification;

class CreateProject extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
                            ->required(),
                        TextInput::make('agency')
                            ->required(),
                        TextInput::make('pic_agency')
                            ->required(),
                    ]),

                // Contract Details
                Section::make('Contract Details')
                    ->schema([
                        TextInput::make('contract_period')
                            ->required()
                            ->integer(),
                        TextInput::make('warranty_period')
                            ->required()
                            ->integer(),
                        DatePicker::make('start_date')
                            ->required(),
                        DatePicker::make('end_date')
                            ->required(),
                    ]),

                // Financial Information
                Section::make('Maklumat Kewangan')
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('RM'),
                        FileUpload::make('SST_file')
                            ->label('SST File'),
                    ]),

                // Additional Information
                Section::make('Maklumat Tambahan')
                    ->schema([
                        Textarea::make('notes')
                            ->required()
                            ->columnSpan('full'),
                        TextInput::make('creator')
                            ->required(),
                        Select::make('status')
                            ->required()
                            ->options([
                                'Berjaya' => 'Berjaya',
                                'Aktif' => 'Aktif',
                                'EOT' => 'EOT',
                                'Tempoh jaminan' => 'Tempoh jaminan',
                                'Selesai' => 'Selesai',
                            ])
                            ->placeholder('Pilih status projek')
                            ->helperText('Staatus projek terkini')
                    ]),
            ])
            ->statePath('data')->inlineLabel();
    }

    public function create()
    {
        if ($this->form->validate()) {
            Project::create($this->form->getState());
            Notification::make()
                ->title('Berjaya')
                ->body('Maklumat berjaya disimpan')
                ->success()
                ->color('success')
                ->seconds(3)
                ->send();
        }
        return to_route('admin.project.index');
    }

    public function render()
    {
        return view('livewire.admin.project.create-project');
    }
}
