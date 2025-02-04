<?php

namespace App\Filament\Resources\AttendeesResource\Pages;

use App\Filament\Resources\AttendeesResource;
use App\Models\Meeting;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class AttendeesMeetings extends EditRecord
{
    protected static string $resource = AttendeesResource::class;
    public function getHeading(): string
    {
        return 'Reuniones de ' . $this->getRecord()->name;
    }
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('')
                ->columns(1)
                ->extraAttributes(['class' => 'max-w-lg'])
                ->compact()
                ->schema([
                    Forms\Components\CheckboxList::make('meetings')
                        ->label('Reuniones')
                        ->relationship('meetings', 'id')
                        ->options(Meeting::query()->orderBy("starts_at", "desc")->get()->mapWithKeys(function ($meeting) {
                            $starts_at = Carbon::parse($meeting->starts_at);
                            return [
                                $meeting->id => $starts_at->isoFormat('D [de] MMMM [del] YYYY [a las] h:mm a'),
                            ];
                        })->toArray())
                ])
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
