<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HorasExtrasResource\Pages;
// use App\Filament\Resources\HorasExtrasResource\RelationManagers;
use App\Models\HorasExtras;
use Carbon\Carbon;
// use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
/* use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope; */
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class HorasExtrasResource extends Resource
{
    protected static ?string $model = HorasExtras::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        $user = Auth::user();

        return $form
            ->schema([
                Section::make('Datos del empleado')->columns(2)->schema([
                    TextInput::make('nombreEmpleado')
                    ->required()
                    ->label('Nombre del empleado')
                    ->default($user->name.' '.$user->apellidos),
                    DatePicker::make('fecha')
                    ->required()
                    ->label('Fecha'),
                    Select::make('dia')
                    ->options([
                        'lunes' => 'Lunes',
                        'martes' => 'Martes',
                        'miercoles' => 'Miércoles',
                        'jueves' => 'Jueves',
                        'viernes' => 'Viernes',
                        'sabado' => 'Sábado',
                        'domingo' => 'Domingo',
                    ])
                    ->searchable()
                    ->required()
                    ->preload()
                    ->live(),
                    TextInput::make('numeroHoras')
                    ->required()
                    ->label('Número de horas'),
                    TimePicker::make('inicioHora')
                    ->label('Inicio de')
                    ->seconds(false)
                    ->afterStateHydrated(function  (TimePicker $component, $state) {
                        $component->state(Carbon::parse($state)->format('h:i A'));
                    })
                    ->required()
                    ->reactive(),
                    TimePicker::make('finHora')
                    ->required()
                    ->label('Fin')
                    ->seconds(false)
                    ->afterStateHydrated(function  (TimePicker $component, $state) {
                        $component->state(Carbon::parse($state)->format('h:i A'));
                    })
                    ->reactive(),
                    TextInput::make('proyecto')
                    ->required()
                    ->label('Departamento / Proyecto')
                    ->default($user->proyecto),
                    TextInput::make('codigoEmpleado')
                    ->required()
                    ->label('Código')
                    ->default($user->codigo),
                    TextInput::make('cargoEmpleado')
                    ->required()
                    ->label('Cargo')
                    ->default($user->cargo),
                    Textarea::make('observaciones')
                    ->required(),
                ]),
                Section::make('Firmas')->columns(2)->schema([
                    SignaturePad::make('firmaEmpleado')
                    ->confirmable()
                    ->label('Firma del empleado')
                    ->required(),
                    SignaturePad::make('firmaAutorizado')
                    ->confirmable()
                    ->label('Autorizado')
                    ->required()
                ]),
                /* Forms\Components\DatePicker::make('fecha'),
                Forms\Components\TextInput::make('dia'),
                Forms\Components\TextInput::make('numeroHoras'),
                Forms\Components\TextInput::make('inicioHora'),
                Forms\Components\TextInput::make('finHora'),
                Forms\Components\TextInput::make('proyecto'),
                Forms\Components\TextInput::make('codigoEmpleado'),
                Forms\Components\TextInput::make('observaciones'),
                Forms\Components\TextInput::make('firmaEmpleado'),
                Forms\Components\TextInput::make('firmaAutorizado'),
                Forms\Components\TextInput::make('users_id')
                    ->numeric(), */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dia')
                    ->searchable()
                    ->label('Día'),
                Tables\Columns\TextColumn::make('numeroHoras')
                    ->searchable()
                    ->label('Número de Horas'),
                Tables\Columns\TextColumn::make('inicioHora')
                    ->searchable()
                    ->label('Inicio')
                    ->dateTime('h:i A'),
                Tables\Columns\TextColumn::make('finHora')
                    ->searchable()
                    ->label('Fin')
                    ->dateTime('h:i a'),
                Tables\Columns\TextColumn::make('proyecto')
                    ->searchable()
                    ->label('Departamento / Proyecto'),
                Tables\Columns\TextColumn::make('codigoEmpleado')
                    ->searchable()
                    ->label('Código'),
                Tables\Columns\TextColumn::make('observaciones')
                    ->searchable(),
                /* Tables\Columns\TextColumn::make('firmaEmpleado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('firmaAutorizado')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, o h:i a')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M j, o h:i a')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                /* Tables\Columns\TextColumn::make('users_id')
                    ->numeric()
                    ->sortable(), */
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListHorasExtras::route('/'),
            'create' => Pages\CreateHorasExtras::route('/create'),
            'edit' => Pages\EditHorasExtras::route('/{record}/edit'),
        ];
    }
}
