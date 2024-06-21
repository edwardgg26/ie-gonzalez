<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function grado_materias(){
        return $this->hasMany(GradoMateria::class);
    }
}
