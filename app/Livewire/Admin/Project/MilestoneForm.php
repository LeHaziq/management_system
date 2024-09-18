<?php

namespace App\Livewire\Admin\Project;

use App\Livewire\BaseForm;
use App\Models\ProjectMilestone;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class MilestoneForm extends BaseForm
{
    public ?ProjectMilestone $projectMilestone = null;
    public $project_id;

    public function mount($project_id = null, $milestone_id = null): void
    {
        if ($milestone_id) {
            $this->projectMilestone = ProjectMilestone::findOrFail($milestone_id);
            $this->project_id = $this->projectMilestone->project_id;
        } else {
            $this->projectMilestone = new ProjectMilestone();
            $this->project_id = $project_id;
        }

        $this->data = $this->projectMilestone->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('project_id'),
                Section::make('Perbatuan Projek')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Perbatuan'),
                        Textarea::make('description')
                            ->required()
                            ->label('Penerangan'),
                        DatePicker::make('start_date')
                            ->required()
                            ->label('Tarikh Mula Perbatuan'),
                        DatePicker::make('end_date')
                            ->required()
                            ->label('Tarikh Tamat Perbatuan'),
                        TextInput::make('progress')
                            ->required(),
                        Select::make('isCompleted')
                            ->options([
                                'Tidak' => 'Tidak',
                                'Ya' => 'Ya',
                            ])
                            ->native(false),
                    ]),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $this->form->getState();

        $this->projectMilestone->fill($this->data);

        // Ensure project_id is set
        if (!$this->projectMilestone->project_id) {
            $this->projectMilestone->project_id = $this->project_id;
        }

        $this->projectMilestone->save();

        Notification::make()
            ->title('Berjaya')
            ->body('Maklumat berjaya disimpan')
            ->success()
            ->color('success')
            ->seconds(3)
            ->send();

        return to_route('admin.project.show', $this->project_id);
    }
}
