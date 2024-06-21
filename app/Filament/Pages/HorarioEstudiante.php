<?php

namespace App\Filament\Pages;

use App\Models\Dia;
use Filament\Pages\Page;
use App\Models\GradoAlumno;

class HorarioEstudiante extends Page
{
    protected static ?string $title = 'Horario';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.pages.horario-estudiante';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('Estudiante');
    }

    protected function getViewData(): array
    {

        return [
            'grados_alumno' => GradoAlumno::join('grados','grados.id','=','grado_alumnos.grado_id')
                                          ->select('grado_alumnos.*')
                                          ->where('grados.year','=',date("Y"))
                                          ->where('alumno_id','=',auth()->user()->id)->get()
        ];
    }
}
