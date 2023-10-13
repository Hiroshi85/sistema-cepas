<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       MetodoPago::create([
           'metodo' => 'Interbank',
           'propietario' => 'Segundo Antero Solano López',
           'tipo' => 'Cuenta corriente',
           'numero' => '8983323433722',
       ]); 
       MetodoPago::create([
        'metodo' => 'Interbank',
        'propietario' => 'Segundo Antero Solano López',
        'tipo' => 'Cuenta interbancaria',
        'numero' => '00389801332343372247',
        ]); 

       MetodoPago::create([
            'metodo' => 'Scotiabank',
            'propietario' => 'IEPM CEPAS',
            'tipo' => 'Cuenta corriente',
            'numero' => '0009082832'
       ]);
       MetodoPago::create([
        'metodo' => 'Scotiabank',
        'propietario' => 'IEPM CEPAS',
        'tipo' => 'Cuenta interbancaria',
        'numero' => '00912100000908283258'
        ]);

       MetodoPago::create([
           'metodo' => 'BCP',
           'propietario' => 'Antero Solano López',
           'tipo' => 'Cuenta de ahorros',
           'numero' => '57098189537003'
       ]);
       MetodoPago::create([
        'metodo' => 'BCP',
        'propietario' => 'Antero Solano López',
        'tipo' => 'Cuenta interbancaria',
        'numero' => '00257019818953700309'
        ]);

       MetodoPago::create([
           'metodo' => 'Yape',
           'propietario' => 'Antero Solano López',
           'numero' => '967090501',
       ]);

       MetodoPago::create(
        [
            'metodo' => 'BBVA Continental',
            'propietario' => 'Antero Solano López',
            'tipo' => 'Cuenta corriente',
            'numero' => '001108140237154563'
        ]
       );
       MetodoPago::create(
        [
            'metodo' => 'BBVA Continental',
            'propietario' => 'Antero Solano López',
            'tipo' => 'Cuenta interbancaria',
            'numero' => '01181400023715456319'
        ]
       );
    }
}
