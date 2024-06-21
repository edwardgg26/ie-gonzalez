<?php

namespace Database\Seeders;

use App\Models\Grado;
use App\Models\GradoAlumno;
use App\Models\GradoMateria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grado::factory(3)
            ->has(GradoMateria::factory(random_int(1,4)),'grado_materias')
            ->has(GradoAlumno::factory(random_int(1,4)),'grado_alumnos')
            ->create();
    }
}
