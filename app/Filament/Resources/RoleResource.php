<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    // --- TRADUCCIONES ---
    protected static ?string $modelLabel = 'Rol';
    protected static ?string $pluralModelLabel = 'Roles';
    protected static ?string $navigationLabel = 'Roles y Permisos';
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre del Rol')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ]),

                Forms\Components\Section::make('Permisos')
                    ->schema([
                        Forms\Components\Toggle::make('acceso_panel_admin')
                            ->label('Permitir acceso al panel de administración')
                            ->helperText('Si esta opción está desactivada, los usuarios con este rol no podrán iniciar sesión.')
                            ->onColor('success')
                            ->offColor('danger'),

                        Forms\Components\Card::make()
                            ->schema(static::getPermissionsSchema())
                            ->columns(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Rol')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha Creación')->dateTime('d/m/Y H:i:s'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    protected static function getPermissionsSchema(): array
    {
        $selectAll = Forms\Components\Checkbox::make('select_all')
            ->label('Seleccionar todos')
            ->afterStateUpdated(function ($state, callable $set) {
                $permissions = Permission::pluck('name')->toArray();
                foreach ($permissions as $permission) {
                    $set($permission, $state);
                }
            })
            ->dehydrated(false);

        $permissionCheckboxes = Permission::all()->map(function ($permission) {
            return Forms\Components\Checkbox::make($permission->name)
                ->label(self::translatePermission($permission->name));
        })->all();

        return array_merge([$selectAll], $permissionCheckboxes);
    }

    /**
     * --- ¡NUEVA FUNCIÓN DE TRADUCCIÓN MEJORADA! ---
     */
    protected static function translatePermission(string $permissionName): string
    {
        // Diccionario de traducciones
        $translations = [
            'view_any' => 'Ver listado de',
            'view' => 'Ver',
            'create' => 'Crear',
            'update' => 'Actualizar',
            'delete' => 'Eliminar',
            'acceso_panel_admin' => 'Acceso al Panel Admin',
            'producto' => 'Producto',
            'venta' => 'Venta',
            'compra' => 'Compra',
            'proveedor' => 'Proveedor',
            'usuario' => 'Usuario',
            'rol' => 'Rol',
        ];

        // Caso especial para la llave maestra
        if ($permissionName === 'acceso_panel_admin') {
            return $translations['acceso_panel_admin'];
        }

        // Separa la acción del modelo (ej. 'view_any', 'producto')
        $parts = explode('_', $permissionName);
        $actionKey = $parts[0] . (isset($parts[1]) && $parts[1] === 'any' ? '_any' : '');
        $modelKey = end($parts);

        // Traduce la acción y el modelo usando el diccionario
        $translatedAction = $translations[$actionKey] ?? Str::title($actionKey);
        $translatedModel = $translations[$modelKey] ?? Str::title($modelKey);

        return $translatedAction . ' ' . $translatedModel;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
