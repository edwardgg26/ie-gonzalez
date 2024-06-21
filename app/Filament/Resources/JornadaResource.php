<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Grado;
use App\Models\Jornada;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JornadaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JornadaResource\RelationManagers;
use Filament\Forms\Components\Hidden;

class JornadaResource extends Resource
{
    protected static ?string $model = Jornada::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Academico';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->unique(ignoreRecord: true)->required(),
                Repeater::make('grados')
                ->label('Grados')
                ->relationship()
                ->schema([
                    Select::make('tipogrado_id')->label('Grado')
                        ->relationship(name: 'tipogrado', titleAttribute:'name')
                        ->required()
                        ->native(false)
                        ->unique(modifyRuleUsing: function (Unique $rule,callable $get) { // $get callable is used 
                            return $rule
                                ->where('tipogrado_id', $get('tipogrado_id')) // get the current value in the 'school_id' field
                                ->where('year', $get('year'))
                                ->where('group', $get('group'));
                            }, 
                        ignoreRecord: true), // ignore current record when editing
        

                    TextInput::make('group')->label('Grupo')->required(),
                    
                    TextInput::make('year')->label('Año')
                        ->numeric()
                        ->default(date('Y'))
                        ->minValue(2010)
                        ->maxValue(date('Y')+1)
                        ->required(),
                ])
                ->addActionLabel('Añadir grado')
                ->columns(3)
                ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')
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
            'index' => Pages\ListJornadas::route('/'),
            'create' => Pages\CreateJornada::route('/create'),
            'edit' => Pages\EditJornada::route('/{record}/edit'),
        ];
    }
}
