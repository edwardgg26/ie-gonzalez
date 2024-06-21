<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dia::create([
            'name' => 'Lunes'
        ]);

        Dia::create([
            'name' => 'Martes'
        ]);

        Dia::create([
            'name' => 'Miercoles'
        ]);

        Dia::create([
            'name' => 'Jueves'
        ]);

        Dia::create([
            'name' => 'Viernes'
        ]);
    }
}
