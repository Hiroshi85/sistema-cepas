<?php

use App\Http\Controllers\AdmisionController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ApoderadoController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoAlumnoController;
use App\Http\Controllers\DocumentoApoderadoController;
use App\Http\Controllers\DocumentoPostulanteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\PruebaPsicologicaController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\PruebaArchivoController;
use App\Http\Controllers\ConductaController;
use App\Http\Controllers\ComportamientoController;

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

    Route::prefix('seguimiento')->middleware('auth')->group(function(){
        Route::get('/', function () {
            return view('seguimiento-dashboard');
        })->name('seguimiento.dashboard');
        Route::resource('asistencias', AsistenciaController::class);
        Route::resource('pruebas', PruebaPsicologicaController::class);
        Route::resource('conductas', ConductaController::class);
        Route::get('buscar/asistencias', [BuscarController::class, 'buscarAsistencia'])->name('asist.buscar');
        Route::get('buscar/alumnos', [BuscarController::class, 'buscarAlumno'])->name('alumn.buscar');
        Route::prefix('comportamientos')->group(function(){
            Route::get('/', [ComportamientoController::class, 'index'])->name('comportamientos.index');
            Route::post('/',[ComportamientoController::class, 'store'])->name('comportamientos.store');
            Route::get('/show', [ComportamientoController::class, 'show'])->name('comportamientos.show');
            Route::get('/alumnos/{id}', [ComportamientoController::class, 'getByAlumno'])->name('comportamientos.get');
            Route::get('/delete/{id}', [ComportamientoController::class, 'destroy'])->name('comportamientos.destroy');
        });
        Route::get('files/{id}', [PruebaArchivoController::class, 'download'])->middleware(['auth', 'role:psicologo'])->name('files');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('admision-matriculas')->group(function () {
        Route::get('/',[DashboardController::class, 'index'])->name('admision-matriculas.dashboard');
        // Apoderados
        Route::resource('/apoderado',ApoderadoController::class)->middleware('auth');
        //Postulantes
        Route::resource('/postulante',PostulanteController::class)->middleware('auth');
        //Estudiantes
        Route::resource('/alumno',AlumnoController::class)->middleware('auth');
        //Aulas
        Route::resource('/aula',AulaController::class)->middleware('auth');
        //Entrevistas
        Route::resource('/entrevista',EntrevistaController::class)->middleware('auth');
        //Matrícula
        Route::resource('/matricula',MatriculaController::class)->middleware('auth');
        //Admision
        Route::resource('/admision', AdmisionController::class)->middleware('auth');
        //Pagos
        Route::resource('/pago', PagoController::class)->middleware('auth');
        Route::resource('/voucher', VoucherController::class)->middleware('auth');
        //Documentos
        Route::resource('/alumno/docsalumno', DocumentoAlumnoController::class)->middleware('auth');
        Route::resource('/apoderado/docsapoderado', DocumentoApoderadoController::class)->middleware('auth');
        Route::resource('/postulante/docspostulante',DocumentoPostulanteController::class)->middleware('auth');
        //Cancel
        Route::get('cancelar/{ruta}', function($ruta) {
            return redirect()->route($ruta);
        })->middleware('auth')->name('cancelar');

    });
});
// Sistema apoderados
Route::get('/apoderados/register',[ApoderadoController::class,'crear'])->name('apoderados.crear');
Route::post('/apoderados/register',[ApoderadoController::class,'registerApoderado'])->name('apoderados.register');

require __DIR__ . '/auth.php';
