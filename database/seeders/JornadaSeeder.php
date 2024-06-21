<?php

namespace Database\Seeders;

use App\Models\Jornada;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jornada::create([
            'name' => 'Mañana'
        ]);

        Jornada::create([
            'name' => 'Tarde'
        ]);
    }
}
