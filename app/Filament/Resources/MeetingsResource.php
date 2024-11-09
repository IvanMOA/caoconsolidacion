<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingsResource\Pages;
use App\Filament\Resources\MeetingsResource\RelationManagers;
use App\Models\Attendee;
use App\Models\AttendeeMeeting;
use App\Models\Meeting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeetingsResource extends Resource
{
    protected static ?int $navigationSort = 1;

    protected static ?string $model = Meeting::class;

    protected static ?string $modelLabel = 'reunión';

    protected static ?string $pluralModelLabel = 'reuniones';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Nombre"),
                Forms\Components\TimePicker::make('starts_at')
                    ->label("Fecha de inicio")
                    ->default(now()),
                Forms\Components\CheckboxList::make('attendees')
                    ->label('Asistencia')
                    ->relationship('attendees', 'id')
                    ->options(Attendee::all()->pluck('name', 'id')->toArray())
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->label("Nombre"),
                Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->label("Fecha de inicio"),
                Columns\TextColumn::make('attendees_count')
                    ->label("Total asistencias")
                    ->counts('attendees')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeetings::route('/create'),
            'edit' => Pages\EditMeetings::route('/{record}/edit'),
        ];
    }
}
