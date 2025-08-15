<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlertaResource\Pages;
use App\Models\Alerta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlertaResource extends Resource
{
    protected static ?string $model = Alerta::class;

    // --- MEJORAS DE TRADUCCIÓN Y PRESENTACIÓN ---
    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';
    protected static ?string $modelLabel = 'Alerta';
    protected static ?string $pluralModelLabel = 'Alertas';
    protected static ?string $navigationGroup = 'Monitoreo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_producto')
                    ->label('Producto')
                    ->relationship('producto', 'descripcion')
                    ->searchable()
                    ->required(),

                // --- ¡LÍNEA CORREGIDA! ---
                // Le decimos a la relación que use 'nombre_estado' para el texto del desplegable.
                Forms\Components\Select::make('id_estado')
                    ->label('Estado de la Alerta')
                    ->relationship('estado', 'nombre_estado')
                    ->required(),

                Forms\Components\TextInput::make('tipo_alerta')
                    ->label('Tipo de Alerta')
                    ->required()
                    ->maxLength(70),

                Forms\Components\Textarea::make('descripcion_alerta')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(130)
                    ->columnSpanFull(),

                Forms\Components\DateTimePicker::make('fecha_aviso')
                    ->label('Fecha del Aviso')
                    ->required()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_alerta')->label('Tipo de Alerta')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('producto.descripcion')->label('Producto')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('estado.nombre_estado')
                    ->label('Estado')
                    ->colors([
                        'primary',
                        'success' => 'Resuelta',
                        'warning' => 'Pendiente',
                        'danger' => 'Crítica',
                    ]),
                Tables\Columns\TextColumn::make('fecha_aviso')->label('Fecha Aviso')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Aseguramos que tenga el botón de borrado
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
            'index' => Pages\ListAlertas::route('/'),
            'create' => Pages\CreateAlerta::route('/create'),
            'edit' => Pages\EditAlerta::route('/{record}/edit'),
        ];
    }
}
