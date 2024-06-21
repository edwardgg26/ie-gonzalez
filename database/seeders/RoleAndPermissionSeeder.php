<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Direccion Academica']);
        Role::create(['name' => 'Secretaria Academica']);
        Role::create(['name' => 'Estudiante']);
        Role::create(['name' => 'Docente']);
    }
}
