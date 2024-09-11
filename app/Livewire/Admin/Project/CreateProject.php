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
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')->required()->columnSpan('full'),
                        TextInput::make('agency')->required(),
                        TextInput::make('pic_agency')->required(),
                    ])->columns(2),

                // Contract Details
                Section::make('Contract Details')
                    ->schema([
                        TextInput::make('contract_period')->required()->integer(),
                        TextInput::make('warranty_period')->required()->integer(),
                        DatePicker::make('start_date')->required(),
                        DatePicker::make('end_date')->required(),
                    ])->columns(2),

                // Financial Information
                Section::make('Financial Information')
                    ->schema([
                        TextInput::make('price')->required()->numeric()->prefix('RM'),
                        FileUpload::make('SST_file')->label('SST File'),
                    ]),

                // Additional Information
                Section::make('Additional Information')
                    ->schema([
                        Textarea::make('notes')->required()->columnSpan('full'),
                        TextInput::make('creator')->required(),
                        Select::make('status')->required()->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                        ]),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        Project::create($this->form->getState())->redirect()->route('admin.project.index');
    }

    public function render()
    {
        return view('livewire.admin.project.create-project');
    }
}
