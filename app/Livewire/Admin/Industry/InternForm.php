<?php

namespace App\Livewire\Admin\Industry;

use App\Livewire\BaseForm;
use App\Models\Intern;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class InternForm extends BaseForm
{
    public ?Intern $intern = null;

    public function mount()
    {
        $this->intern ??= new Intern();
        $this->data = $this->intern->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Maklumat Peribadi')
                    ->description('Maklumat asas mengenai individu')
                    ->schema([
                        TextInput::make('name')->required()->label('Nama'),
                        TextInput::make('ic')->required()->label('IC'),
                        TextInput::make('email')->required()->email()->label('E-Mel'),
                    ]),
                Section::make('Maklumat Pengajian')
                    ->description('Maklumat mengenai tahap pengajian')
                    ->schema([
                        TextInput::make('education_level')->label('Tahap Akademik'),
                        TextInput::make('education_institution')->label('Sekolah/Universiti'),
                        TextInput::make('year')->label('Tahun Akademik')->numeric(),
                        TextInput::make('skill')->label('Kemahiran'),
                    ]),
                Section::make('Maklumat Latihan Industri')
                    ->description('Maklumat mengenai latihan industri')
                    ->schema([
                        DatePicker::make('start_date')->label('Tarikh Mula Latihan'),
                        DatePicker::make('end_date')->label('Tarikh Tamat Latihan'),
                    ]),
                Section::make('Dokumen')
                    ->description('Muat naik dokumen yang diperlukan')
                    ->schema([
                        FileUpload::make('photo')->label('Foto'),
                        FileUpload::make('resume')->label('Resume'),
                    ]),
                Section::make('Status')
                    ->description('Status pelatih')
                    ->schema([
                        Select::make('status')->label('Status')->options([
                            'diterima' => 'Diterima',
                            'ditolak' => 'Ditolak',
                            'aktif' => 'Aktif',
                            'tamat' => 'Tamat',
                        ])
                            ->native(false),
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
            $state['internship_period'] = $startDate->diffInMonths($endDate);
        }

        $this->intern->fill($state)->save();

        Notification::make()
            ->title('Berjaya')
            ->body('Maklumat pelatih berjaya disimpan')
            ->success()
            ->send();

        return redirect()->route('admin.intern.index');
    }
}
