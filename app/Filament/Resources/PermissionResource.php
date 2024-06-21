<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Permission;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers;
use Althinect\FilamentSpatieRolesPermissions\Resources\PermissionResource as ResourcesPermissionResource;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationGroup = 'Administración';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\Select::make('guard_name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                    ->options(config('filament-spatie-roles-permissions.guard_names'))
                    ->default(config('filament-spatie-roles-permissions.default_guard_name'))
                    ->visible(fn () => config('filament-spatie-roles-permissions.should_show_guard', true))
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('roles', null))
                    ->required(),

                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.roles'))
                    ->relationship(
                        name: 'roles',
                        titleAttribute: 'name',
                        modifyQueryUsing: function(Builder $query, Get $get) {
                            if (!empty($get('guard_name'))) {
                                $query->where('guard_name', $get('guard_name'));
                            }
                            if(Filament::hasTenancy()) {
                                return $query->where(config('permission.column_names.team_foreign_key'), Filament::getTenant()->id);
                            }
                            return $query;
                        }
                    )
                    ->preload(config('filament-spatie-roles-permissions.preload_roles', true)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                    ->searchable()
                    ->sortable(),
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

    public static function getPluralModelLabel(): string
    {
        return __('Permisos');
    }

    public static function getModelLabel(): string
    {
        return __('Permiso');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            // 'create' => Pages\CreatePermission::route('/create'),
            // 'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
