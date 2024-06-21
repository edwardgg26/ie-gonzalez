<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\GradoMateria;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\GradoMateriaResource\Pages;
use App\Filament\Resources\GradoMateriaResource\RelationManagers;

class GradoMateriaResource extends Resource
{
    protected static ?string $model = GradoMateria::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('grado')
                    ->content(fn($record)=> $record ? $record->grado->tipogrado->num.'-'.$record->grado->group .' ' . $record->grado->year : null),
                Placeholder::make('materia')
                    ->content(fn($record)=> $record ? $record->materia->name : null),
                Placeholder::make('docente')
                    ->content(fn($record)=> $record ? $record->docente->name : null),
                Placeholder::make('dia')
                    ->content(fn($record)=> $record ? $record->dia->name : null),
                Placeholder::make('hora')
                    ->content(fn($record)=> $record ? Carbon::parse($record->hora->hora)->format('g:i A') : null),
                Placeholder::make('aula')
                    ->content(fn($record)=> $record ? $record->aula->aula : null),

                Repeater::make('notas')->label('Alumnos')
                ->relationship()
                ->schema([
                    Placeholder::make('alumno')
                        ->content(fn($record)=> $record ? $record->grado_alumno->alumno->name : null),
                    // Placeholder::make('correo')
                    //     ->content(fn($record)=> $record ? $record->grado_alumno->alumno->email : null),
                    TextInput::make('periodo1')->label('Periodo 1')->numeric()->minValue(0)->maxValue(5),
                    TextInput::make('periodo2')->label('Periodo 2')->numeric()->minValue(0)->maxValue(5),
                    TextInput::make('periodo3')->label('Periodo 3')->numeric()->minValue(0)->maxValue(5),
                    Placeholder::make('definitiva')
                    ->content(fn($record)=> $record ? $record->periodo1 * 0.30 + $record->periodo2 * 0.30 + $record->periodo3 * 0.40 : null),
                ])
                ->deletable(false)
                ->addable(false)
                ->reorderable()
                ->columns(5)
                // ->columns(6)
                ->collapsible()
                ->addActionLabel('Añadir alumno')
                ->columnSpan(3)
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('materia.name'),
                TextColumn::make('combined_info')
                ->label('Grado')
                ->getStateUsing(function (GradoMateria $record) {
                    return $record->grado->tipogrado->num.'-'.$record->grado->group .' ' . $record->grado->year;
                }),
                TextColumn::make('dia.name'),
                TextColumn::make('hora.hora')->time('g:i A'),
                TextColumn::make('aula.aula'),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->where('docente_id','=',auth()->user()->id)
                                                            ->join('horas','horas.id','=','grado_materias.hora_id')
                                                            ->join('grados','grados.id','=','grado_materias.grado_id')
                                                            ->select('grado_materias.*') 
                                                            ->where('grados.year',date('Y'))
                                                            ->orderBy('dia_id')->orderBy('horas.hora'))
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPluralModelLabel(): string
    {
        return __('Materias');
    }

    public static function getModelLabel(): string
    {
        return __('Materia');
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
            'index' => Pages\ListGradoMaterias::route('/'),
            'edit' => Pages\EditGradoMateria::route('/{record}/edit'),
        ];
    }
}
