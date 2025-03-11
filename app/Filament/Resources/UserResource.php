<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
//use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
//use Coolsam\SignaturePad\Forms\Components\Fields\SignaturePad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
/* use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope; */
use Filament\Forms\Components\Section;
/* use Saade\FilamentAutograph\Forms\Components\Enums\DownloadableFormat;
use Saade\FilamentAutograph\Forms\Components\SignaturePad; */
use Filament\Forms\Components\TextInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $pluralModelLabel = 'Empleados';
    protected static ?string $navigationLabel = 'Empleados';
    protected static ?string $modelLabel = 'Emepleado';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Datos empleado')->columns(2)
                ->schema([
                    TextInput::make('name')
                    ->required()
                    ->label('Nombre'),
                    Forms\Components\TextInput::make('apellidos')
                    ->required(),
                    Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->label('Código'),
                    Forms\Components\TextInput::make('proyecto')
                    ->required(),
                    Forms\Components\TextInput::make('cargo')
                    ->required(),
                    Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Correo'),
                    Forms\Components\TextInput::make('password')
                    ->password()
                    ->hiddenOn('edit')
                    ->required()
                    ->label('Contraseña'),
                    Forms\Components\TextInput::make('pais')
                    ->required()
                    ->label('País'),
                ]),
                /* Section::make('Firmas Digitales')
                ->schema([
                    //SignaturePad::make('firma')
                    SignaturePad::make('signature')
                    ->filename('autograph')
                    ->downloadable()
                    ->downloadableFormats([
                        DownloadableFormat::PNG,
                        DownloadableFormat::JPG,
                    ])
                    ->downloadActionDropdownPlacement('center-end')
                    ->confirmable()
                ]) */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable()
                    ->label('Apellidos'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Correo'),
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable()
                    ->label('Código'),
                Tables\Columns\TextColumn::make('cargo')
                    ->searchable()
                    ->label('Cargo'),
                Tables\Columns\TextColumn::make('proyecto')
                    ->searchable()
                    ->label('Departamento / Proyecto'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Correo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
