<?php

namespace App\Models;

use App\Models\Materia;
use App\Observers\GradoMateriaObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(GradoMateriaObserver::class)]
class GradoMateria extends Model
{
    use HasFactory;

    protected $fillable = [
        'grado_id',
        'materia_id',
        'dia_id',
        'hora_id',
        'docente_id'
    ];

    public function grado(){
        return $this->belongsTo(Grado::class);
    }

    public function materia(){
        return $this->belongsTo(Materia::class);
    }

    public function materias(){
        return $this->belongsToMany(Materia::class);
    }

    public function dia(){
        return $this->belongsTo(Dia::class)->orderBy('id');
    }

    public function hora(){
        return $this->belongsTo(Hora::class);
    }

    public function docente(){
        return $this->belongsTo(User::class)->role('Docente');
    }

    public function aula(){
        return $this->belongsTo(Aula::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
