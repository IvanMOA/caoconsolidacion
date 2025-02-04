<?php

namespace App\Filament\Resources\NewAttendeesResource\Pages;

use App\Filament\Resources\NewAttendeesResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateNewAttendees extends CreateRecord
{
    protected static string $resource = NewAttendeesResource::class;
    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__("Ir a registro"))
            ->submit('create')
            ->keyBindings(['mod+s'])
            ->color('gray');
    }
    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->label(__("Confirmar"))
            ->action('createAnother')
            ->keyBindings(['mod+shift+s'])
            ->color('primary');
    }
}
