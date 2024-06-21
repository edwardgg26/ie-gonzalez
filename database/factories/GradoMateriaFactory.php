<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Dia;
use App\Models\Hora;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GradoMateria>
 */
class GradoMateriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'materia_id' => Materia::inRandomOrder()->first()->id,
            'docente_id' => User::role('Docente')->inRandomOrder()->first()->id,
            'dia_id' =>Dia::inRandomOrder()->first()->id,
            'hora_id' =>Hora::inRandomOrder()->first()->id,
            'aula_id' =>Aula::inRandomOrder()->first()->id,
        ];
    }
}
