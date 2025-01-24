<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendeesResource\Pages;
use App\Filament\Resources\AttendeesResource\RelationManagers;
use App\Models\Attendee;
use App\Models\Tool;
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

    protected static ?string $modelLabel = 'congregante';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_recurrent', true);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->columns(1)
                    ->extraAttributes(['class' => 'max-w-lg'])
                    ->compact()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Nombre"),
                        Forms\Components\DatePicker::make('birthday')
                            ->label("Fecha de nacimiento"),
                        Forms\Components\TextInput::make('phone')
                            ->label("Teléfono"),
                        Forms\Components\TextInput::make('who_invited_me')
                            ->label("Invitado por"),
                        Forms\Components\Radio::make('has_gone_to_another_church')
                            ->options([
                             true => 'Sí',
                            false => 'No',
                            ]),
                        Forms\Components\TextInput::make('church_name')
                            ->label("Nombre de la iglesia"),
                        Forms\Components\TextInput::make('is_interested_in_bible_study')
                            ->label("¿Interesado en asistir a un estudio biblico?"),
                        Forms\Components\TextInput::make('requests')
                            ->label("Peticiones")
                            ->disabled(),
                        Forms\Components\DatePicker::make('date_of_welcome')
                            ->label("Fecha"),
                        Forms\Components\Fieldset::make('Herramientas')
                            ->schema([
                                Forms\Components\CheckboxList::make('tools')
                                    ->relationship('tools', 'id')
                                    ->options(Tool::all()->pluck('name', 'id')->toArray())
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->label("Nombre"),
                Columns\TextColumn::make('meetings_count')
                    ->label("Total asistencias")
                    ->counts('meetings'),
                Columns\TextColumn::make('tools_count')
                    ->label("Total herramientas")
                    ->counts('tools')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
}
