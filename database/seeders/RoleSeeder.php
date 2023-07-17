<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin']);
        Role::create(['name' => 'apoderado']);
        Role::create(['name' => 'secretario(a)']);
        Role::create(['name' => 'auxiliar']);
        Role::create(['name' => 'psicologo']);

        $role2 = Role::create(['name' => 'Alumno']);
        $role3 = Role::create(['name' => 'Docente']);
        $role4 = Role::create(['name' => 'Coordinador Academico']);
        $role5 = Role::create(['name' => 'Supervisor']);

        // ADMIN
        Permission::create(['name' => 'cursos.index'])->syncRoles($role1);
        Permission::create(['name' => 'asignar'])->syncRoles($role1);
        
        // DOCENTE
        Permission::create(['name' => 'miscursos'])->syncRoles($role3);

        // ALUMNO
        Permission::create(['name' => 'miscalificaciones'])->syncRoles($role2);

        // COORDINADOR
        Permission::create(['name' => 'verdocumentos'])->syncRoles($role1,$role4);

        // SUPERVISOR
        Permission::create(['name' => 'evaluardocentes'])->syncRoles($role1,$role5);
    }
}
