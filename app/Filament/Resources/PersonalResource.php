<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalResource\Pages;
// use App\Filament\Resources\PersonalResource\RelationManagers;
use App\Models\Personal;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\ImportAction;
// use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
/* use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope; */
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class PersonalResource extends Resource
{
    protected static ?string $model = Personal::class;
    protected static ?string $pluralModelLabel = 'Registros personales';
    protected static ?string $navigationLabel = 'Registros Acción Personal';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        return $form
            ->schema([
                Section::make('Datos del empleado')->columns(2)
                ->schema([
                    DatePicker::make('fechaRecepcion')
                    ->required()
                    ->label('Fecha de recepción')
                    ->default(Carbon::now()),
                    TextInput::make('nombreEmpleado')
                    ->required()
                    ->label('Nombre del empleado')
                    ->default($user->name.' '.$user->apellidos),
                    TextInput::make('codigoEmpleado')
                    ->required()
                    ->label('Código')
                    ->default($user->codigo),
                    TextInput::make('cargoEmpleado')
                    ->required()
                    ->label('Cargo')
                    ->default($user->cargo),
                    TextInput::make('proyectoEmpleado')
                    ->required()
                    ->label('Departamento / Proyecto')
                    ->default($user->proyecto),
                ]),
                Section::make('Nombre de Acción')
                ->columns(2)
                ->schema([
                    Select::make('accion')
                    ->options([
                        'vacación' => 'Vacación',
                        'incapacidad' => 'Incapacidad',
                        'promoción' => 'Promoción',
                        'aumento_salario' => 'Aumento de salario',
                        'despido_indemnización' => 'Despido con indemnización',
                        'despido_sin_indemnización' => 'Despido sin indemnización',
                        'licencia_sin_goce_sueldo' => 'Licencia sin goce de sueldo',
                        'licencia_con_goce_sueldo' => 'Licencia con goce de sueldo',
                        'contratación_temporal' => 'Contratación Temporal',
                        'amonestación_escrita' => 'Amonestación Escrita',
                        'falta_injustificada' => 'Falta injustificada',
                        'renuncia' => 'Renuncia',
                        'fallecimiento_familiar' => 'Fallecimiento de familiar',
                        'jubilación' => 'Jubilación',
                        'abandono_trabajo' => 'Abandono de trabajo',
                        'suspensión_indisciplina' => 'Suspensión por indisciplina',
                        'contratación_fija' => 'Contratación fija',
                        'cita_médica' => 'Cita médica ISSS',
                        'otros' => 'Otros: finalización contrato',
                    ])
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()
                    ->label('Tipo de acción'),
                    DatePicker::make('fechaefectivo')
                    ->required()
                    ->label('Efectivo a partir de'),
                ]),
                Section::make('Especificaciones Adicionales')
                ->columns(2)
                ->description('Situación actual')
                ->schema([
                    TextInput::make('nombreUnidad')
                    ->required()
                    ->label('Nombre unidad'),
                    TextInput::make('centroCosto')
                    ->required()
                    ->label('Centro de costo'),
                    TextInput::make('puestoActual')
                    ->required()
                    ->label('Puesto actual'),
                    TextInput::make('salarioActual')
                    ->required()
                    ->label('Salario actual')
                    ->placeholder('0,00')
                    ->prefixIcon('heroicon-m-currency-dollar'),
                ]),
                Section::make('Especificaciones Adicionales')
                ->columns(2)
                ->description('Situación propuesta')
                ->schema([
                    TextInput::make('nombreUnidadPropuesto')
                    ->required()
                    ->label('Nombre unidad'),
                    TextInput::make('centroCostoPropuesto')
                    ->required()
                    ->label('Centro de costo'),
                    TextInput::make('puestoPropuesto')
                    ->required()
                    ->label('Puesto actual'),
                    TextInput::make('nuevoSalario')
                    ->required()
                    ->placeholder('0,00')
                    ->label('Nuevo salario')
                    ->prefixIcon('heroicon-m-currency-dollar'),
                    DatePicker::make('fechaAumento')
                    ->required()
                    ->label('Fecha de aumento'),
                ]),
                Section::make('Información Requerida')
                ->description('Espacio para ampliar información')
                ->schema([
                    Textarea::make('infoRequerida')
                    ->required()
                    ->label('Información Requerida')
                ]),
                Section::make('Autorizaciones Requeridas')
                ->columns(2)
                ->schema([
                    SignaturePad::make('firmaEmpleado')
                    ->confirmable()
                    ->label('Firma Empleado')
                    ->required(),
                    SignaturePad::make('firmaJefe')
                    ->confirmable()
                    ->label('Jefe Inmediato')
                    ->required(),
                    SignaturePad::make('firmaGerente')
                    ->confirmable()
                    ->label('Gerente de Recursos Humanos')
                    ->required(),
                    SignaturePad::make('firmaDirector')
                    ->confirmable()
                    ->label('Director Administrativo')
                    ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fechaRecepcion')
                ->label('Fecha de recepción')
                ->date()
                ->sortable(),
                TextColumn::make('nombreEmpleado')
                ->label('Nombre del empleado'),
                TextColumn::make('proyectoEmpleado')
                ->label('Departamento / Proyecto')
                ->searchable(),
                TextColumn::make('cargoEmpleado')
                ->label('Cargo'),
                TextColumn::make('codigoEmpleado')
                ->label('Código'),
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
            'index' => Pages\ListPersonals::route('/'),
            'create' => Pages\CreatePersonal::route('/create'),
            'edit' => Pages\EditPersonal::route('/{record}/edit'),
        ];
    }
}
