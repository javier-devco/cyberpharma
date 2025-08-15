<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstadoResource\Pages;
use App\Models\Estado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EstadoResource extends Resource
{
    protected static ?string $model = Estado::class;

    // --- MEJORAS DE TRADUCCIÓN Y PRESENTACIÓN ---
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Estado';
    protected static ?string $pluralModelLabel = 'Estados';
    // Creamos un nuevo grupo para mantener el menú ordenado
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?int $navigationSort = 1; // Para ordenar dentro del grupo

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_estado')
                    ->label('Nombre del Estado')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true), // Asegura que no haya estados duplicados
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_estado')
                    ->label('Nombre del Estado')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
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
            'index' => Pages\ListEstados::route('/'),
            'create' => Pages\CreateEstado::route('/create'),
            'edit' => Pages\EditEstado::route('/{record}/edit'),
        ];
    }
}
