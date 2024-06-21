<?php

namespace App\Filament\Pages;

use App\Models\GradoMateria;
use Filament\Pages\Page;

class HorarioDocente extends Page
{
    protected static ?string $title = 'Horario';
    
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.horario-docente';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('Docente');
    }
}
