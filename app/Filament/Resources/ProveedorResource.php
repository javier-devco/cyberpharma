<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProveedorResource\Pages;
use App\Models\Proveedor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProveedorResource extends Resource
{
    protected static ?string $model = Proveedor::class;

    // --- MEJORAS DE TRADUCCIÓN Y PRESENTACIÓN ---
    protected static ?string $navigationIcon = 'heroicon-o-truck'; // Un ícono más representativo
    protected static ?string $modelLabel = 'Proveedor';
    protected static ?string $pluralModelLabel = 'Proveedores';
    protected static ?string $navigationGroup = 'Gestión de Productos'; // Para agrupar en el menú

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_proveedor')
                    ->label('Nombre del Proveedor') // Traducción
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('direccion')
                    ->label('Dirección') // Traducción
                    ->required()
                    ->maxLength(60),
                Forms\Components\TextInput::make('telefono')
                    ->label('Teléfono') // Traducción
                    ->tel() // Especificamos que es un campo de teléfono
                    ->required()
                    ->maxLength(40),
                Forms\Components\TextInput::make('correo_electronico')
                    ->label('Correo Electrónico') // Traducción
                    ->email() // Especificamos que es un campo de email y añadimos validación
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_proveedor')
                    ->label('Nombre del Proveedor') // Traducción
                    ->searchable() // Hacemos la columna buscable
                    ->sortable(), // Hacemos la columna ordenable
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono') // Traducción
                    ->searchable(),
                Tables\Columns\TextColumn::make('correo_electronico')
                    ->label('Correo Electrónico') // Traducción
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación') // Traducción
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Oculta por defecto, pero se puede mostrar
            ])
            ->filters([
                // Los filtros se pueden añadir aquí más adelante
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Añadimos acción de borrado
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProveedors::route('/'),
            'create' => Pages\CreateProveedor::route('/create'),
            'edit' => Pages\EditProveedor::route('/{record}/edit'),
        ];
    }
}
