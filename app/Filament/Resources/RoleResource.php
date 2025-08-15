<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $modelLabel = 'Rol';
    protected static ?string $pluralModelLabel = 'Roles y Permisos';
    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre del Rol')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Section::make('Permisos')
                    ->schema(self::generatePermissionSections()),
            ]);
    }

    private static function generatePermissionSections(): array
    {
        $sections = [];
        $actions = ['view_any', 'delete_any', 'view', 'create', 'update', 'delete'];

        $permissions = Permission::all()->groupBy(function ($permission) use ($actions) {
            if ($permission->name === 'access_panel') {
                return 'panel';
            }
            foreach ($actions as $action) {
                if (Str::startsWith($permission->name, $action . '_')) {
                    return Str::after($permission->name, $action . '_');
                }
            }
            return 'general';
        });

        if (isset($permissions['panel'])) {
            $sections[] = Forms\Components\Section::make(trans('resources.panel'))
                ->schema([
                    Forms\Components\CheckboxList::make('panel')
                        ->label('Acciones Permitidas')
                        ->options($permissions['panel']->pluck('name', 'name')->mapWithKeys(function ($name) {
                            return [$name => 'Permitir acceso al panel de administración'];
                        }))
                        ->columns(1),
                ]);
        }

        foreach ($permissions as $resource => $permissionGroup) {
            if (in_array($resource, ['general', 'panel'])) continue;

            $sections[] = Forms\Components\Section::make(trans('resources.' . $resource))
                ->schema([
                    Forms\Components\CheckboxList::make($resource)
                        ->label('Acciones Permitidas')
                        ->options($permissionGroup->pluck('name', 'name')->mapWithKeys(function ($name) use ($actions) {
                            $actionName = '';
                            foreach ($actions as $action) {
                                if (Str::startsWith($name, $action . '_')) {
                                    $actionName = $action;
                                    break;
                                }
                            }
                            return [$name => trans('actions.' . $actionName)];
                        }))
                        ->columns(4)
                        ->bulkToggleable(),
                ])
                ->collapsible();
        }
        return $sections;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Rol')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha Creación')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]); // <-- ¡EL PUNTO Y COMA FALTANTE ESTABA AQUÍ!
    }

    public static function getRelations(): array
    {
        return [];
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
