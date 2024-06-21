<?php

namespace Database\Factories;

use App\Models\Grado;
use App\Models\Jornada;
use App\Models\TipoGrado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grado>
 */
class GradoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'grado_id'=>Grado::factory(),
            'tipogrado_id' => TipoGrado::inRandomOrder()->first()->id,
            'jornada_id' => Jornada::inRandomOrder()->first()->id,
            'group' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'year' => $this->faker->numberBetween(2019,2024),
        ];
    }
}
