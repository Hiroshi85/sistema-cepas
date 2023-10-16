<?php

namespace Database\Seeders;

use App\Models\Admision;
use App\Models\Alumno;
use App\Models\Postulante;
use App\Models\PostulanteAdmision;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;

class PostulanteSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admision::create([
            'año' => '2023',
            'fecha_apertura' => now('America/Lima')->toDateString(),
            'fecha_cierre' => Carbon::parse( now('America/Lima')->toDateString())->addMonth(), 
            'tarifa' => 50,
            'estado' => 'Aperturada',
        ]);

        for ($i = 1; $i<= 10; $i++){
            Postulante::factory(20)->create(
                ['idaula' => $i]
            )->each(function ($postulante) {
                if ($postulante->estado == 'Aceptado'){
                    // Crear historial de postulación 
                    $this->crearHistoriaPostulacion($postulante);
                    // Crear alumno
                    $this->crearAlumno($postulante);
                }
                if($postulante->estado == 'Rechazado')
                    $this->crearHistoriaPostulacion($postulante);
            });     
        }
       
    }

    private function crearHistoriaPostulacion($postulante){
        PostulanteAdmision::create([
            'idpostulante' => $postulante->idpostulante,
            'idadmision' => 1,
            'fecha_registro' => now('America/Lima')->toDateString(),
            'resultado' => $postulante->estado,
        ]);
    }

    private function crearAlumno($postulante){
        Alumno::factory(1)->create([
            'idaula' => $postulante->idaula,
            'idpostulante' => $postulante->idpostulante,
            'nombre_apellidos' => $postulante->nombre_apellidos,
            'fecha_nacimiento' => $postulante->fecha_nacimiento,
            'dni' => $postulante->dni,
            'domicilio' => $postulante->domicilio,
            'numero_celular' => $postulante->numero_celular,
            'nro_hermanos' => $postulante->nro_hermanos,
            'eliminado' => 0,
        ])->each(
            function ($alumno) {
                User::factory()->create([
                    'name' => $alumno->nombre_apellidos,
                     'dni' => $alumno->dni,
                     'email' => 'a'. $alumno->dni . '@gmail.com',
                     'password' => bcrypt('password'),
                ])->assignRole('Alumno');
            }
        );
    }
}
