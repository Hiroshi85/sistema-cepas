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
        Role::create(['name' => 'director(a)']);
        Role::create(['name' => 'auxiliar']);
        Role::create(['name' => 'psicologo']);

        $alumno = Role::create(['name' => 'Alumno']);
        $docente = Role::create(['name' => 'Docente']);
        $coord = Role::create(['name' => 'Coordinador Academico']);
        $coordinador_rrhh = Role::create(['name' => 'Coordinador de Recursos Humanos']);
        $espe_recluta = Role::create(['name' => 'Especialista en Reclutamiento']);
        $enc_evalua = Role::create(['name' => 'Encargado de Evaluación']);
        $enc_nominas = Role::create(['name' => 'Empleado de Nóminas']);

        // ADMIN
        Permission::create(['name' => 'cursos.index'])->syncRoles($admin);
        Permission::create(['name' => 'asignar'])->syncRoles($admin);

        // DOCENTE
        Permission::create(['name' => 'miscursos'])->syncRoles($docente);

        // ALUMNO
        Permission::create(['name' => 'miscalificaciones'])->syncRoles($alumno);
        Permission::create(['name' => 'misencuestas'])->syncRoles($alumno);

        // COORDINADOR
        Permission::create(['name' => 'verdocumentos'])->syncRoles($coord);
        Permission::create(['name' => 'evaluardocentes'])->syncRoles($coord);
        Permission::create(['name' => 'iniciarencuestas'])->syncRoles($coord);

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

        // Permisos para el "Empleado de Nóminas"
        $nominas = Permission::create(['name' => 'gestionar nominas']);
        $nominas_ver = Permission::create(['name' => 'ver nominas']);

        $coordinador_rrhh->givePermissionTo([$ofertas, $contratos, $empleados, $puestos, $equipos, $postulaciones_ver, $nominas_ver]);
        $espe_recluta->givePermissionTo([$candidatos, $plazas, $postulaciones, $programarentrevistas, $postulaciones_ver]);
        $enc_evalua->givePermissionTo([$evaluaciones, $entrevistas, $programarentrevistas, $postulaciones_ver]);
        $enc_nominas->givePermissionTo([$nominas]);


                // Nombres de los permisos que deseas excluir
        $permisosExcluidos = ['miscursos', 'miscalificaciones', 'misencuestas','verdocumentos','iniciarencuestas'];

        // Obtén todos los permisos excepto los excluidos
        $permisosParaOtorgar = Permission::whereNotIn('name', $permisosExcluidos)->get();

        $admin->givePermissionTo($permisosParaOtorgar);
        
        // $admin->givePermissionTo($permisosParaOtorgar);
        // $admin->givePermissionTo(Permission::all());
    }
}
