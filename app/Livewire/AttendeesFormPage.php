<?php

namespace App\Livewire;

use App\Filament\Resources\NewAttendeesResource;
use App\Models\Attendee;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Notifications\Notification;
use Livewire\Component;

class AttendeesFormPage extends Component implements HasForms {
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }
    public function form(Form $form): Form
    {
        return NewAttendeesResource::form($form)
            ->statePath('data');
    }
    public function create(): void
    {
        Attendee::create($this->form->getState());
        $this->form->fill();
        Notification::make()
            ->success()
            ->title("Registro completado")
            ->body("Bienvenido")
            ->send();
    }
    public function render()
    {
        return view('livewire.attendees-form-page');
    }
}
