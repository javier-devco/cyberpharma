<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Usuario';
    protected static ?string $pluralModelLabel = 'Usuarios';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nombre')->required(),
                                Forms\Components\TextInput::make('apellido')->required(),
                                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),

                                // --- CAMBIO 1: Relación de Roles ---
                                // Este campo ahora solo maneja la relación con los roles.
                                Forms\Components\Select::make('roles')
                                    ->relationship('roles', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),

                                Forms\Components\TextInput::make('edad')->numeric()->required(),
                                Forms\Components\DatePicker::make('fecha_ingreso')->label('Fecha de Ingreso')->required()->default(now()),

                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->label('Contraseña')
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->confirmed(),

                                Forms\Components\TextInput::make('password_confirmation')
                                    ->password()
                                    ->label('Confirmar Contraseña')
                                    ->dehydrated(false),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('apellido')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->label('Roles')->badge(),
                Tables\Columns\TextColumn::make('edad')->sortable(),
                Tables\Columns\TextColumn::make('fecha_ingreso')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    // NO NECESITAMOS LOS MÉTODOS mutateFormData... PORQUE USAREMOS OTRA TÉCNICA

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
