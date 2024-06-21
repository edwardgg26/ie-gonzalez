<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Role;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RoleResource\Pages;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationGroup = 'Administración';

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
                    ->required(),

                Forms\Components\Select::make('permissions')
                    ->columnSpanFull()
                    ->multiple()
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions'))
                    ->relationship(
                        name: 'permissions',
                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('name'),
                    )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} ({$record->guard_name})")
                    ->searchable(['name', 'guard_name']) // searchable on both name and guard_name
                    ->preload(config('filament-spatie-roles-permissions.preload_permissions')),
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
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRoles::route('/'),
            // 'create' => Pages\CreateRole::route('/create'),
            // 'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
