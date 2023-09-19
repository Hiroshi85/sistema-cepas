<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Postulante;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //['idaula','idpostulante','nombre_apellidos', 'fecha_nacimiento', 'dni', 'domicilio', 'numero_celular', 'nro_hermanos', 'estado', 'eliminado'];
        for ($i = 1; $i<= 10; $i++){
            Postulante::factory(20)->create(
                ['idaula' => $i]
            )->each(function ($postulante) {
                if ($postulante->estado == 'Aceptado'){
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
            });     
        }
       
    }
}
