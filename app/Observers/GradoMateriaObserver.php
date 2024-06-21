<?php

namespace App\Observers;

use App\Models\Nota;
use App\Models\GradoMateria;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class GradoMateriaObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the GradoMateria "created" event.
     */
    public function created(GradoMateria $gradoMateria): void
    {
        // dd('Se llama observer grado materia');
        DB::transaction(function() use($gradoMateria){
            $grado_alumnos = DB::table('grado_alumnos')->where('grado_id','=',$gradoMateria->grado_id)->get();
            if($grado_alumnos){
                foreach($grado_alumnos as $grado_alumno){
                    Nota::create([
                        'grado_materia_id' => $gradoMateria->id,
                        'grado_alumno_id'=>$grado_alumno->id,
                        'periodo1'=>0,
                        'periodo2'=>0,
                        'periodo3'=>0
                    ]);
                }
            }
        });
    }

    /**
     * Handle the GradoMateria "updated" event.
     */
    public function updated(GradoMateria $gradoMateria): void
    {
        //
    }

    /**
     * Handle the GradoMateria "deleted" event.
     */
    public function deleted(GradoMateria $gradoMateria): void
    {
        //
    }

    /**
     * Handle the GradoMateria "restored" event.
     */
    public function restored(GradoMateria $gradoMateria): void
    {
        //
    }

    /**
     * Handle the GradoMateria "force deleted" event.
     */
    public function forceDeleted(GradoMateria $gradoMateria): void
    {
        //
    }
}
