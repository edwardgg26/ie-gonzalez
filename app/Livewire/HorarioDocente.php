<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\GradoMateria;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HorarioDocente extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(function(){
                return GradoMateria::where('docente_id','=',auth()->user()->id)
                                    ->join('grados','grados.id','=','grado_materias.grado_id')
                                    ->join('horas','horas.id','=','grado_materias.hora_id')
                                    ->where('year','=',date('Y'))
                                    ->select('grado_materias.*') 
                                    ->orderBy('dia_id')->orderBy('horas.hora');
            })
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
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         //
            //     ]),
            // ])
            ->paginated(false);
    }



    public function render()
    {
        return view('livewire.horario-docente');
    }
}
