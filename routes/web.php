<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuestoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('rrhh')->group(function () {
        Route::get('/', function () {
            return view('rrhh-dashboard');
        })->name('rrhh.dashboard');
        Route::resource('/empleados', EmpleadoController::class);
        Route::controller(PostulacionController::class)->group(
            function () {
                Route::get('/postulaciones', 'index')->name('postulaciones.index');
                Route::get('/postulaciones/create', 'create')->name('postulaciones.create');
                Route::get('/postulaciones/{postulacion}/edit', 'edit')->name('postulaciones.edit');
                Route::get('/postulaciones/{postulacion}', 'show')->name('postulaciones.show');
                Route::post('/postulaciones', 'store')->name('postulaciones.store');
                Route::put('/postulaciones/{postulacion}', 'update')->name('postulaciones.update');
                Route::delete('/postulaciones/{candidato}/delete', 'destroyByCandidato')->name('postulaciones.destroyByCandidato');
                Route::delete('/postulaciones/porplaza/{plaza}/delete', 'destroyByPlaza')->name('postulaciones.destroyByPlaza');
                Route::delete('/postulaciones/{postulacion}', 'destroy')->name('postulaciones.destroy');
            }
        );
        Route::resource('/candidatos', CandidatoController::class);
        Route::resource('/plazas', PlazaController::class);
        Route::resource('/puestos', PuestoController::class);
        Route::resource('/equipos', EquipoController::class);
        Route::resource('/horarios', HorarioController::class);
        Route::resource('/nomina', NominaController::class);
    });
});



require __DIR__ . '/auth.php';
