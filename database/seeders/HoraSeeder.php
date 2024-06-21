<?php

namespace Database\Seeders;

use App\Models\Hora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Hora::create([
            'hora' => '07:00:00'
        ]);

        Hora::create([
            'hora' => '14:00:00'
        ]);

        Hora::create([
            'hora' => '15:00:00'
        ]);

        Hora::create([
            'hora' => '16:00:00'
        ]);

        Hora::create([
            'hora' => '17:00:00'
        ]);

        Hora::create([
            'hora' => '18:00:00'
        ]);
    }
}
