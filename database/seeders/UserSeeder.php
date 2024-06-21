<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Generar super admin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'supadmin@iegonzalez.com',
        ])->assignRole('Super Admin');

        //Generar alumnos
        User::factory(10)->create()->each(function($user){
            $user->assignRole('Estudiante');
        });

        //Generar docentes
        User::factory(10)->create()->each(function($user){
            $user->assignRole('Docente');
        });
    }
}
