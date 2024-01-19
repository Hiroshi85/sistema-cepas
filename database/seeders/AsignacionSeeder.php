<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CursoAsignado;
use App\Models\Asignatura;
use App\Models\Aula;
use App\Models\Rrhh\Empleado;

class AsignacionSeeder extends Seeder
{
    public function run()
    {
        // Obtener la lista de docentes, aulas y cursos desde la base de datos
            $docentes = Empleado::where('EsDocente', 1)->get();
            $aulas = Aula::all();
            $cursos = Asignatura::all();

            // Obtener los días de la semana (puedes personalizar según tus necesidades)
            $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

            foreach ($aulas as $aula) {
                // Obtener los cursos disponibles para el grado del aula
                $cursosDisponibles = $cursos->where('grado', $aula->grado);

                // Verificar si hay suficientes cursos disponibles para asignar 7 cursos
                if ($cursosDisponibles->count() < 7) {
                    // Manejar caso en el que no hay suficientes cursos disponibles
                    continue;
                }

                // Obtener 7 cursos aleatorios sin repetición
                $cursosAsignados = $cursosDisponibles->random(7);

                // Iterar sobre los cursos asignados y asignar aula, docente y horario aleatorio
                foreach ($cursosAsignados as $curso) {
                    // Obtener un docente aleatorio
                    $docente = $docentes->random();

                    // Obtener un día de la semana aleatorio
                    $horario = $diasSemana[array_rand($diasSemana)];

                    // Crear el CursoAsignado
                    CursoAsignado::create([
                        'idcurso'   => $curso->id,
                        'idaula'    => $aula->idaula,
                        'iddocente' => $docente->id,
                        'horario'   => $horario,
                    ]);
                }
            }

    }
}
