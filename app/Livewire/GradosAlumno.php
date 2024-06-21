<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\GradoAlumno;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradosAlumno extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public GradoAlumno $grado_alumno;

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn (): HasMany => $this->grado_alumno->notas())
            ->columns([
                // TextColumn::make('id'),
                TextColumn::make('grado_materia.materia.name'),
                TextColumn::make('grado_materia.docente.name'),
                TextColumn::make('periodo1')->label('Periodo 1')->alignCenter(),
                TextColumn::make('periodo2')->label('Periodo 2')->alignCenter(),
                TextColumn::make('periodo3')->label('Periodo 3')->alignCenter(),
                TextColumn::make('definitiva')->alignCenter()
                    ->state(function ($record){
                        $definitiva = $record->periodo1 * 0.30 + $record->periodo2 * 0.30 + $record->periodo3 * 0.40;

                        return $definitiva;
                    }),
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

    public function render(): View
    {
        return view('livewire.grados-alumno',[
            'grado_alumno' => $this->grado_alumno
        ]);
    }
}
