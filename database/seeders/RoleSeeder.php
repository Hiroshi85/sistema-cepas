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
        $admin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'apoderado']);
        Role::create(['name' => 'secretario(a)']);
        Role::create(['name' => 'auxiliar']);
        Role::create(['name' => 'psicologo']);

        $role2 = Role::create(['name' => 'Alumno']);
        $role3 = Role::create(['name' => 'Docente']);
        $role4 = Role::create(['name' => 'Coordinador Academico']);
        $coordinador_rrhh = Role::create(['name' => 'Coordinador de Recursos Humanos']);
        $espe_recluta = Role::create(['name' => 'Especialista en Reclutamiento']);
        $enc_evalua = Role::create(['name' => 'Encargado de Evaluación']);

        // ADMIN
        Permission::create(['name' => 'cursos.index'])->syncRoles($admin);
        Permission::create(['name' => 'asignar'])->syncRoles($admin);

        // DOCENTE
        Permission::create(['name' => 'miscursos'])->syncRoles($role3);

        // ALUMNO
        Permission::create(['name' => 'miscalificaciones'])->syncRoles($role2);

        // COORDINADOR
        Permission::create(['name' => 'verdocumentos'])->syncRoles($role4);
        Permission::create(['name' => 'evaluardocentes'])->syncRoles($role4);

        // Permisos para el "Coordinador de Recursos Humanos"
        $ofertas = Permission::create(['name' => 'gestionar ofertas']);
        $contratos = Permission::create(['name' => 'gestionar contratos']);
        $empleados = Permission::create(['name' => 'gestionar empleados']);
        $puestos = Permission::create(['name' => 'gestionar puestos']);
        $equipos = Permission::create(['name' => 'gestionar equipos']);


        // Permisos para el "Especialista en Reclutamiento"
        $candidatos = Permission::create(['name' => 'gestionar candidatos']);
        $plazas = Permission::create(['name' => 'gestionar plazas']);
        $postulaciones = Permission::create(['name' => 'gestionar postulaciones']);

        // Permisos para el "Encargado de Evaluación"
        $evaluaciones = Permission::create(['name' => 'gestionar evaluaciones']);
        $entrevistas = Permission::create(['name' => 'gestionar entrevistas']);
        $postulaciones_ver = Permission::create(['name' => 'ver postulaciones']);
        $programarentrevistas = Permission::create(['name' => 'programar entrevistas']);

        $coordinador_rrhh->givePermissionTo([$ofertas, $contratos, $empleados, $puestos, $equipos, $postulaciones_ver]);
        $espe_recluta->givePermissionTo([$candidatos, $plazas, $postulaciones, $programarentrevistas, $postulaciones_ver]);
        $enc_evalua->givePermissionTo([$evaluaciones, $entrevistas, $programarentrevistas, $postulaciones_ver]);

        // $admin->givePermissionTo(Permission::all());
    }
}
