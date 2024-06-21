<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'grado_materia_id',
        'grado_alumno_id',
        'periodo1',
        'periodo2',
        'periodo3'
    ];

    public function grado_alumno(){
        return $this->belongsTo(GradoAlumno::class);
    }

    public function grado_materia(){
        return $this->belongsTo(GradoMateria::class);
    }
}
