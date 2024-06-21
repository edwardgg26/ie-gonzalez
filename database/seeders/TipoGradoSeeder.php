<?php

namespace Database\Seeders;

use App\Models\TipoGrado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoGradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoGrado::create([
            'name' => 'Sexto',
            'num' => 6
        ]);

        TipoGrado::create([
            'name' => 'Septimo',
            'num' => 7
        ]);

        TipoGrado::create([
            'name' => 'Octavo',
            'num' => 8
        ]);

        TipoGrado::create([
            'name' => 'Noveno',
            'num' => 9
        ]);

        TipoGrado::create([
            'name' => 'Decimo',
            'num' => 10
        ]);

        TipoGrado::create([
            'name' => 'Once',
            'num' => 11
        ]);
    }
}
