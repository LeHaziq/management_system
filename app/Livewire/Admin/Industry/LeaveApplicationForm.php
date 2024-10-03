<?php

namespace App\Livewire\Admin\Industry;

use App\Livewire\BaseForm;
use App\Models\Intern;
use App\Models\LeaveApplication;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class LeaveApplicationForm extends BaseForm
{
    public ?LeaveApplication $leaveApplication = null;

    public function mount()
    {
        $this->leaveApplication ??= new LeaveApplication();
        $this->data = $this->leaveApplication->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Borang Permohonan Cuti')
                    ->schema([
                        Select::make('intern_id')->required()->label('Nama')
                            ->required()
                            ->label('Nama')
                            ->placeholder('Pilih Pelatih')
                            ->options(Intern::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live(),
                        Textarea::make('reason')->required()->label('Alasan'),
                        DatePicker::make('start_date')->required()->label('Tarikh Mula Cuti'),
                        DatePicker::make('end_date')->required()->label('Tarikh Tamat Cuti'),
                        Select::make('status')
                            ->options([
                                'Permohonan' => 'Permohonan',
                                'Diterima' => 'Diterima',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->label('Status Cuti'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $state = $this->form->getState();

        // Recalculate internship period before saving
        if ($state['start_date'] && $state['end_date']) {
            $startDate = Carbon::parse($state['start_date']);
            $endDate = Carbon::parse($state['end_date']);
            $state['leave_duration'] = $startDate->diffInDays($endDate);
        }

        $this->leaveApplication->fill($state)->save();

        Notification::make()
            ->title('Berjaya')
            ->body('Maklumat berjaya disimpan')
            ->success()
            ->send();

        return redirect()->route('admin.leave.index');
    }
}
