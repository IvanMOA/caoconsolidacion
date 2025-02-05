<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingsResource\Pages;
use App\Filament\Resources\MeetingsResource\RelationManagers;
use App\Models\Attendee;
use App\Models\AttendeeMeeting;
use App\Models\Meeting;
use Carbon\Carbon;
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
                Forms\Components\Section::make('')
                    ->columns(1)
                    ->extraAttributes(['class' => 'max-w-lg'])
                    ->compact()
                    ->schema([
                        Forms\Components\DateTimePicker::make('starts_at')
                            ->label("Fecha de inicio")
                            ->default(Carbon::now('America/Monterrey'))
                            ->timezone('America/Monterrey')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->label("Fecha de inicio"),
                 Columns\TextColumn::make('attendees_count')
                     ->badge()
                     ->label("Total asistentes")
                     ->counts('attendees')
                     ->url(fn ($record) => route('filament.admin.resources.meetings.attendees', ['record' => $record->id]))
                     ->openUrlInNewTab(false),
            ])
            ->defaultSort("starts_at", "desc")
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
            'attendees' => Pages\MeetingsAttendees::route('/{record}/attendees'),
        ];
    }
}
