<?php

namespace App\Livewire;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

abstract class BaseForm extends Component implements HasActions, HasForms
{
    use InteractsWithForms, InteractsWithActions;

    public array $data = [];

    abstract public function form(Form $form): Form;

    public function render()
    {

        return view('livewire.base-form');
    }
}
