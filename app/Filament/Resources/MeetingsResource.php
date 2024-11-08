<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingsResource\Pages;
use App\Filament\Resources\MeetingsResource\RelationManagers;
use App\Models\Meetings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeetingsResource extends Resource
{
    protected static ?string $model = Meetings::class;

    protected static ?string $modelLabel = 'reunión';

    protected static ?string $pluralModelLabel = 'reuniones';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Nombre"),
                Forms\Components\TimePicker::make('starts_at')
                    ->label("Fecha de inicio")
                    ->default(now())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->label("Nombre"),
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
