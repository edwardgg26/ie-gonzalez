<?php

namespace App\Livewire;

use App\Models\Dia;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables;
use App\Models\Grado;
use Filament\Tables\Table;
use App\Models\GradoAlumno;
use App\Models\GradoMateria;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class HorarioAlumno extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public GradoAlumno $grado_alumno;

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn (): BelongsToMany => $this->grado_alumno->grado_materias())
            ->columns([

                TextColumn::make('materia.name'),
                TextColumn::make('dia.name'),
                TextColumn::make('hora.hora')->time('g:i A'),
                TextColumn::make('docente.name'),
                TextColumn::make('aula.aula'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->paginated(false);
    }

    public function render()
    {
        return view('livewire.horario-alumno');
    }
}
