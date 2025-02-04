<?php

namespace App\Filament\Resources\AttendeesResource\Pages;

use App\Filament\Resources\AttendeesResource;
use App\Models\Meeting;
use App\Models\Tool;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class AttendeesTools extends EditRecord
{
    protected static string $resource = AttendeesResource::class;
    public function getHeading(): string
    {
        return 'Herramientas de ' . $this->getRecord()->name;
    }
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('')
                ->columns(1)
                ->extraAttributes(['class' => 'max-w-lg'])
                ->compact()
                ->schema([

                    Forms\Components\CheckboxList::make('tools')
                        ->label("Herramientas")
                        ->relationship('tools', 'id')
                        ->options(Tool::all()->pluck('name', 'id')->toArray())
                ]),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
