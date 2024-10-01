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
                        TextInput::make('name')->required()->label('Nama'),
                        TextInput::make('ic')->required()->label('IC'),
                        TextInput::make('email')->required()->email()->label('E-Mel'),
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
