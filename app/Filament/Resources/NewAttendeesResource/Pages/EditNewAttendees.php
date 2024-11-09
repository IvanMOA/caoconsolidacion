<?php

namespace App\Filament\Resources\NewAttendeesResource\Pages;

use App\Filament\Resources\NewAttendeesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewAttendees extends EditRecord
{
    protected static string $resource = NewAttendeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
