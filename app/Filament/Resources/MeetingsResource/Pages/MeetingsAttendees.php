<?php

namespace App\Filament\Resources\MeetingsResource\Pages;

use App\Filament\Resources\MeetingsResource;
use App\Models\Attendee;
use App\Models\Tool;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;

class MeetingsAttendees extends EditRecord
{
    protected static string $resource = MeetingsResource::class;

    public function getHeading(): string
    {
        return 'Asistentes';
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
                        ->label('Asistencia')
                        ->relationship('attendees', 'id')
                        ->options(Attendee::all()->pluck('name', 'id')->toArray())
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
