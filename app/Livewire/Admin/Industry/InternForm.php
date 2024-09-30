<?php

namespace App\Livewire\Admin\Industry;

use App\Livewire\BaseForm;
use App\Models\Intern;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class InternForm extends BaseForm
{
    public ?Intern $intern = null;

    public function mount(Intern $intern = null): void
    {
        $this->intern = $intern ?? new Intern();
        $this->data = $this->intern->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Maklumat Asas')
                    ->description('Maklumat asas mengenai individu')
                    ->schema([
                        TextInput::make('name')->required()->label('Name'),
                        TextInput::make('email')->required()->email()->label('E-Mel'),
                        FileUpload::make('letter')->label('Letter'),
                    ]),

                Section::make('Maklumat Pengajian')
                    ->description('Maklumat mengenai tahap pengajian')
                    ->schema([
                        TextInput::make('education_level')->required()->label('Tahap Pengajian'),
                        TextInput::make('education_year')->required()->label('Tahun Pengajian')->numeric(),
                        TextInput::make('school_university')->required()->label('Sekolah/Universiti'),
                    ]),

                Section::make('Maklumat Latihan')
                    ->description('Maklumat mengenai tempoh latihan')
                    ->schema([
                        TextInput::make('training_period')->required()->label('Tempoh Latihan')->numeric(),
                        DatePicker::make('start_date')->required()->label('Tarikh Mula Latihan'),
                        DatePicker::make('end_date')->required()->label('Tarikh Tamat Latihan'),
                    ]),

                Section::make('Dokumen')
                    ->description('Muat naik dokumen yang diperlukan')
                    ->schema([
                        FileUpload::make('picture')->label('Gambar (upload)'),
                        FileUpload::make('resume')->label('Resume (upload)'),
                    ]),

                Section::make('Status')
                    ->description('Status permohonan')
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->native(false)
                            ->options([
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                                'active' => 'Active',
                                'completed' => 'Completed',
                                'review' => 'Review',
                            ])
                            ->label('Status'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $this->form->getState();

        $this->intern->fill([
            ...$this->data,
        ])->save();

        Notification::make()
            ->title('Berjaya')
            ->body('Maklumat pelatih berjaya disimpan')
            ->success()
            ->send();

        return redirect()->route('admin.intern.index');
    }
}
