<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGrado extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    // public function grados(){
    //     return $this->hasMany(Grado::class);
    // }
}
