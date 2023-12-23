<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tabla = DB::table('users');
        $tabla->insert([
            'name' => 'admin',
            'dni' => '99999999',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234'),
        ]);

        $adminUser = User::where('email', 'admin@gmail.com')->first();
        // Asignar el rol 'admin' al usuario
        
        $adminUser->assignRole("admin");

        //Secretaria
        $tabla->insert([
            'name' => 'secretaria',
            'dni' => '78154464',
            'email' => 'secretaria@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $secretariaUser = User::where('email', 'secretaria@gmail.com')->first();
        $secretariaUser->assignRole('secretario(a)');

        //Director
        $tabla->insert([
            'name' => 'director',
            'dni' => '78104465',
            'email' => 'director@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $directorUser = User::where('email', 'director@gmail.com')->first();
        $directorUser->assignRole('director(a)');
    }
}
