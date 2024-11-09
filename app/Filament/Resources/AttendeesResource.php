<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendeesResource\Pages;
use App\Filament\Resources\AttendeesResource\RelationManagers;
use App\Models\Attendee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendeesResource extends Resource
{
    protected static ?int $navigationSort = 2;

    protected static ?string $model = Attendee::class;

    protected static ?string $modelLabel = 'congredado';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_recurrent', true);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->label("Nombre"),
                Columns\TextColumn::make('meetings_count')
                    ->label("Total asistencias")
                    ->counts('meetings')
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendees::route('/'),
            'create' => Pages\CreateAttendees::route('/create'),
            'edit' => Pages\EditAttendees::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }
    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
