<?php

namespace Database\Seeders;

use App\Models\Apoderado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApoderadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // factory(Usuario::class, 10)->create()->each(function ($usuario) {
        //     // Asociar un apoderado ficticio a cada usuario
        //     $apoderado = factory(Apoderado::class)->create();
        //     $usuario->apoderado_id = $apoderado->id;
        //     $usuario->save();
        // });
        //Seed 10 users and asociate 10 apoderados to the userid
        User::factory(20)->create()->each(function ($user) {
            $apoderado = Apoderado::factory()->create([
                'idusuario' => $user->id,
                'correo' => $user->email,
                'dni' => $user->dni,
                'nombre_apellidos' => $user->name,
            ]);
            $apoderado->save();
            $user->assignRole('apoderado');
        });
    }
}
