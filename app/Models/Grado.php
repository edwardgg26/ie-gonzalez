<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $fillable = [
       'tipogrado_id',
       'group',
       'jornada_id',
       'year'
    ];

    public function tipogrado(){
        return $this->belongsTo(TipoGrado::class)->orderBy('num');
    }

    public function jornada(){
        return $this->belongsTo(Jornada::class);
    }

    public function grado_alumnos(){
        return $this->hasMany(GradoAlumno::class);
    }

    public function grado_materias(){
        return $this->hasMany(GradoMateria::class);
    }
}
