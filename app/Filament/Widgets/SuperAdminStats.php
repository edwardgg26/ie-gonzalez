<?php

namespace App\Filament\Widgets;

use App\Models\Grado;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return  [
            Stat::make('Alumnos', User::role('Estudiante')->count()),
            Stat::make('Docentes', User::role('Docente')->count()),
            Stat::make('Grados actuales', Grado::where('year',date('Y'))->count()),
            Stat::make('Grados totales', Grado::count()),
        ] ;
    }

    public static function canView(): bool
    {
        return auth()->user()->isSuperAdmin();
    }
}
