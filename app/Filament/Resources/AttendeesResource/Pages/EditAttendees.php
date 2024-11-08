<?php

namespace App\Filament\Resources\AttendeesResource\Pages;

use App\Filament\Resources\AttendeesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttendees extends EditRecord
{
    protected static string $resource = AttendeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
