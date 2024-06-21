<?php

namespace App\Filament\Widgets;

use App\Models\Grado;
use App\Models\GradoAlumno;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EstudianteStats extends BaseWidget
{
    protected function getStats(): array
    {

        $grado_actual = Grado::join('grado_alumnos','grados.id','=','grado_alumnos.grado_id')
        ->where('alumno_id','=',auth()->user()->id)
        ->where('grados.year','=',date('Y'))->first();

        return [
            Stat::make('Grado actual', $grado_actual->tipogrado->num.' '.$grado_actual->group.' '.$grado_actual->year)
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Estudiante');
    }
}
