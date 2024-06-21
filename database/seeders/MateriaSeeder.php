<?php

namespace Database\Seeders;

use App\Models\Materia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materia::create([
            'name' => 'Castellano'
        ]);

        Materia::create([
            'name' => 'Inglés'
        ]);

        Materia::create([
            'name' => 'Matematicas'
        ]);

        Materia::create([
            'name' => 'Artistica'
        ]);

        Materia::create([
            'name' => 'Educación Fisica'
        ]);

        Materia::create([
            'name' => 'Quimica'
        ]);

        Materia::create([
            'name' => 'Ciencias Sociales'
        ]);

    }
}
