<?php

namespace App\Observers;

use App\Models\Grado;
use App\Models\GradoAlumno;
use App\Models\GradoMateria;
use App\Models\Nota;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class GradoAlumnoObserver implements ShouldHandleEventsAfterCommit
{
    
    /**
     * Handle the GradoAlumno "created" event.
     */
    public function created(GradoAlumno $gradoAlumno): void
    {
        // dd('Se llama observer grado alumno');
        DB::transaction(function() use($gradoAlumno){
            $grado_materias = DB::table('grado_materias')->where('grado_id','=',$gradoAlumno->grado_id)->get();
            if($grado_materias){
                foreach($grado_materias as $grado_materia){
                    Nota::create([
                        'grado_materia_id' => $grado_materia->id,
                        'grado_alumno_id'=>$gradoAlumno->id,
                        'periodo1'=>0,
                        'periodo2'=>0,
                        'periodo3'=>0
                    ]);
                }
            }
        });
    }

    /**
     * Handle the GradoAlumno "updated" event.
     */
    public function updated(GradoAlumno $gradoAlumno): void
    {
        //
    }

    /**
     * Handle the GradoAlumno "deleted" event.
     */
    public function deleted(GradoAlumno $gradoAlumno): void
    {
        //
    }

    /**
     * Handle the GradoAlumno "restored" event.
     */
    public function restored(GradoAlumno $gradoAlumno): void
    {
        //
    }

    /**
     * Handle the GradoAlumno "force deleted" event.
     */
    public function forceDeleted(GradoAlumno $gradoAlumno): void
    {
        //
    }
}
