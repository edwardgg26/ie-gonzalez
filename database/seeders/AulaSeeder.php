<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aula::create([
            'aula' => 1001
        ]);

        Aula::create([
            'aula' => 1002
        ]);

        Aula::create([
            'aula' => 1003
        ]);

        Aula::create([
            'aula' => 1004
        ]);
    }
}
