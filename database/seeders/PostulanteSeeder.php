<?php

namespace Database\Seeders;

use App\Models\Admision;
use App\Models\Alumno;
use App\Models\AlumnoMatricula;
use App\Models\ApoderadoPostulante;
use App\Models\Matricula;
use App\Models\Postulante;
use App\Models\PostulanteAdmision;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;
use Faker\Factory;

class PostulanteSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 5 ; $i++) {
            //create admision and matricula since 2020 to 2024
            $fechaApertura = null;
            if ($i == 4 )
                $fechaApertura = Carbon::now('America/Lima');
            else
                $fechaApertura = Carbon::create(2020 + $i, rand(1, 12), rand(1, 28));
            $fechaCierre = $fechaApertura->copy()->addMonth();
            Admision::create([
                'año' => (string) $fechaApertura->year,
                'fecha_apertura' => $fechaApertura->toDateString(),
                'fecha_cierre' => $fechaCierre->toDateString(),
                'tarifa' => 50,
                'estado' => $i == 4 ? 'Aperturada' : 'Cerrada',
            ]);

            Matricula::create([
                'año' => (string) $fechaApertura->year,
                'fecha_apertura' => $fechaApertura->toDateString(),
                'fecha_cierre' => $fechaCierre->toDateString(),
                'tarifa' => 300,
                'estado' => $i == 4 ? 'Aperturada' : 'Cerrada',
            ]);
        }

        // Poblando postulantes y alumnos en el proceso del año actual
        $faker = Factory::create();
        for ($i = 1; $i<= 10; $i++){
            Postulante::factory(50)->create(
                ['idaula' => $i]
            )->each(function ($postulante) use ($faker){
                if ($postulante->estado == 'Aceptado'){
                    // Crear alumno
                    $this->crearAlumno($postulante);
                }
                if($postulante->estado != 'Registrado')
                    // Crear historial de postulación
                    $this->crearHistoriaPostulacion($postulante);
                else
                {
                    //genera intentos de postulación fallidos en periodos anteriores 2018-2022
                    for ($i = 1; $i <= 5; $i++){
                        if ($i == 5) break;
                        PostulanteAdmision::create([
                            'idpostulante' => $postulante->idpostulante,
                            'idadmision' => $i,
                            'fecha_registro' => Carbon::create(2018 + $i, rand(1, 12), rand(1, 28)),
                            'resultado' => $faker->randomElement(['En postulación','Entrevista pendiente', 'Rechazado'])
                        ]);
                    }
                }
            });
        }

        $this->createApoderadoPostulante();
    }

    private function crearHistoriaPostulacion($postulante){
        PostulanteAdmision::create([
            'idpostulante' => $postulante->idpostulante,
            'idadmision' => 5,
            'fecha_registro' => now('America/Lima')->toDateString(),
            'resultado' => $postulante->estado,
        ]);
    }

    private function crearHistoriaMatricula($alumno){
        for ($i=5; $i > 5-$alumno->aula->grado ; $i--) {
            $matricula = Matricula::findOrFail($i);
            $matricula->total_alumnos++; //total alumnos entre matriculados y no matriculados
            $matricula->save();
            if ($alumno->estado != "Matriculado" && $i == 5) continue;
            AlumnoMatricula::create([
                'idalumno' => $alumno->idalumno,
                'idmatricula' => $i,
                'fecha_registro' => Carbon::create(2018 + $i, rand(1, 12), rand(1, 28)),
                'aula' => $alumno->aula->grado.$alumno->aula->seccion,
            ]);
        }
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

                $this->crearHistoriaMatricula($alumno);
            }
        );
    }

    private function createApoderadoPostulante(){
        $postulantes = Postulante::all();
        foreach($postulantes as $p){
            ApoderadoPostulante::createApoderadoPostulante(rand(1,15), $p->idpostulante);
        }
    }
}
