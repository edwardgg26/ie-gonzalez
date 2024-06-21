<?php

namespace App\Models;

use App\Observers\GradoAlumnoObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(GradoAlumnoObserver::class)]
class GradoAlumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'grado_id',
        'alumno_id'
    ];

    public function alumno(){
        return $this->belongsTo(User::class)->role('Estudiante');
    }

    public function grado(){
        return $this->belongsTo(Grado::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function grado_materias(){
        return $this->belongsToMany(GradoMateria::class, 'notas')
                    ->join('horas','horas.id','=','grado_materias.hora_id')
                    ->select('grado_materias.*')
                    ->orderBy('dia_id')->orderBy('horas.hora');
    }
}
