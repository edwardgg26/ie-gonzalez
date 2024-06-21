<?php

namespace App\Filament\Widgets;

use App\Models\GradoMateria;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DocenteStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cursos actuales', GradoMateria::where('docente_id','=',auth()->user()->id)
                                                    ->join('grados','grados.id','=','grado_materias.grado_id')
                                                      ->where('year','=',date('Y'))->count()),
            Stat::make('Cursos totales', GradoMateria::where('docente_id','=',auth()->user()->id)->count())
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Docente');
    }
}
