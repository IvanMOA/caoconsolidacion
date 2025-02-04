<?php

namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use App\Models\Attendee;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;

class ToolsAttendees extends EditRecord
{
    protected static string $resource = ToolsResource::class;
    public function getHeading(): string
    {
        return $this->getRecord()->name;
    }
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('')
                ->columns(1)
                ->extraAttributes(['class' => 'max-w-lg'])
                ->compact()
                ->schema([
                    Forms\Components\CheckboxList::make('attendees')
                        ->label('Personas')
                        ->relationship('attendees', 'id')
                        ->options(Attendee::query()->where("is_recurrent", "=", true)->get()->pluck('name', 'id')->toArray())
                        ->searchable()
                ])
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
