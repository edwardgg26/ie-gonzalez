<?php

namespace App\Filament\Pages;

use App\Models\GradoAlumno;
use Filament\Pages\Page;

class AlumnoNotas extends Page
{
    protected static ?string $title = 'Notas';
    
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static string $view = 'filament.pages.alumno-notas';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('Estudiante');
    }

    protected function getViewData(): array
    {
        return [
            'grados_alumno' => GradoAlumno::where('alumno_id','=',auth()->user()->id)->orderByDesc('id')->get()
        ];
    }
}
