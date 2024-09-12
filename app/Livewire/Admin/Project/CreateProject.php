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
                            ->required()
                            ->label('Nama projek'),
                        TextInput::make('agency')
                            ->required()
                            ->label('Agensi'),
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
