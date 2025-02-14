<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewAttendeesResource\Pages;
use App\Models\Attendee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewAttendeesResource extends Resource
{

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Visitante';


    protected static ?string $model = Attendee::class;


    protected static ?string $modelLabel = 'congregado';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_recurrent', false);
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
                            ->label("Nombre")
                            ->required(),

                        Forms\Components\Fieldset::make('Información de cumpleaños')
                            ->schema([
                                Forms\Components\Grid::make(2) // Usamos 2 columnas
                                ->schema([
                                    Forms\Components\Select::make('birth_day')
                                        ->label('Día')
                                        ->options(array_combine(range(1, 31), range(1, 31))),
                                    Forms\Components\Select::make('birth_month')
                                        ->label('Mes')
                                        ->options([
                                            '01' => 'Enero',
                                            '02' => 'Febrero',
                                            '03' => 'Marzo',
                                            '04' => 'Abril',
                                            '05' => 'Mayo',
                                            '06' => 'Junio',
                                            '07' => 'Julio',
                                            '08' => 'Agosto',
                                            '09' => 'Septiembre',
                                            '10' => 'Octubre',
                                            '11' => 'Noviembre',
                                            '12' => 'Diciembre',
                                        ])
                                ]),
                            ])
                            ->columns(2),
                        Forms\Components\TextInput::make('phone')
                            ->label("Teléfono"),
                        Forms\Components\TextInput::make('who_invited_me')
                            ->label("Persona que te invito"),
                        Forms\Components\Radio::make('has_gone_to_another_church')
                            ->options([
                             true => 'Sí',
                            false => 'No',
                            ])
                            ->label("¿Has asistido a otra congregación cristiana?")
                            ->reactive(),
                        Forms\Components\TextInput::make('church_name')
                            ->label("Nombre de la iglesia")
                            ->visible(fn ($get) => $get('has_gone_to_another_church') == true),
                        Forms\Components\Radio::make('is_interested_in_bible_study')
                            ->options([
                                true => 'Sí',
                                false => 'No',
                            ])
                            ->label("¿Interesado en asistir a un estudio biblico?"),
                        Forms\Components\TextInput::make('requests')
                            ->label("Peticiones"),
                        Forms\Components\DatePicker::make('date_of_welcome')
                            ->label("Fecha")
                            ->default(now()),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->label("Nombre"),
                Columns\ToggleColumn::make('is_recurrent')
                    ->label("Es recurrente"),
                Columns\TextColumn::make('who_invited_me')
                    ->label("Invitado por"),
            Columns\TextColumn::make('phone')
            ->label("Teléfono"),
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
            'index' => Pages\ListNewAttendees::route('/'),
            'create' => Pages\CreateNewAttendees::route('/create'),
            'edit' => Pages\EditNewAttendees::route('/{record}/edit'),
        ];
    }
}
