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
use App\Http\Controllers\EntrevistaCandidatoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EvaluacionCandidatoController;
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
// DESEMPEÑO
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CursoAsignadoController;
use App\Http\Controllers\SilaboController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\EvaluacionDocenteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CalificacionController;
use Illuminate\Support\Facades\Route;

//SEGUIMIENTO
use App\Http\Controllers\AsistenciaXDiaController;
use App\Http\Controllers\PruebaPsicologicaController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\PruebaArchivoController;
use App\Http\Controllers\ConductaController;
use App\Http\Controllers\ComportamientoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\SesionPruebaController;

// Materiales Escolares
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturaDetalleController;
use App\Http\Controllers\MaterialEscolarController;
use App\Http\Controllers\ParentescoController;
use App\Http\Controllers\ProveedorController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Seguimiento Escolar
Route::prefix('seguimiento')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('seguimiento-dashboard');
    })->name('seguimiento.dashboard');
    Route::resource('asistenciaxdias', AsistenciaXDiaController::class);
    Route::resource('pruebas', PruebaPsicologicaController::class);
    Route::resource('conductas', ConductaController::class);
    Route::get('buscar/asistencias', [BuscarController::class, 'buscarAsistencia'])->name('asist.buscar');
    Route::get('buscar/alumnos', [BuscarController::class, 'buscarAlumno'])->name('alumn.buscar');
    Route::prefix('comportamientos')->group(function () {
        Route::get('/', [ComportamientoController::class, 'index'])->name('comportamientos.index');
        Route::post('/', [ComportamientoController::class, 'store'])->name('comportamientos.store');
        Route::get('/show', [ComportamientoController::class, 'show'])->name('comportamientos.show');
        Route::get('/alumnos/{id}', [ComportamientoController::class, 'getByAlumno'])->name('comportamientos.get');
        Route::get('/delete/{id}', [ComportamientoController::class, 'destroy'])->name('comportamientos.destroy');
    });
    Route::get('files/{id}', [PruebaArchivoController::class, 'download'])->name('files');

    Route::get('sesiones/{id}/alumno/{alumno_id}', [SesionPruebaController::class, 'evaluar'])->name('sesiones.evaluar');
    Route::put('sesiones/{id}/alumno/{alumno_id}', [SesionPruebaController::class, 'evaluarPut'])->name('sesiones.evaluarPut');
    Route::resource('sesiones', SesionPruebaController::class);
});

//RRHH
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
                Route::get('/postulaciones/{postulacion}.pdf', 'loadSinglePdf')->name('postulaciones.pdf.show');
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
        Route::get('/evaluaciones/{evaluacion}.pdf', [EvaluacionCandidatoController::class, 'loadSinglePdf'])
            ->name('rrhh.evaluaciones.pdf.show');
        Route::resource('/evaluaciones', EvaluacionCandidatoController::class)
            ->parameter('evaluaciones', 'evaluacion')
            ->names('rrhh.evaluaciones');
        Route::get('/evaluaciones/{postulacion}/create', [EvaluacionCandidatoController::class, 'createForAPostulacion'])
            ->name('rrhh.evaluaciones.createForAPostulacion');
        Route::put('/evaluaciones/{evaluacion}/finalizar', [EvaluacionCandidatoController::class, 'finalizarEvaluacion'])
            ->name('rrhh.evaluaciones.finalizarEvaluacion');
        Route::resource('/entrevistas', EntrevistaCandidatoController::class)
            ->parameter('entrevistas', 'entrevista')
            ->names('rrhh.entrevistas');
        Route::get('/entrevistas/{evaluacion}/create', [EntrevistaCandidatoController::class, 'createForAEvaluacion'])
            ->name('rrhh.entrevistas.createForAEvaluacion');
        Route::put('/entrevistas/{entrevista}/finalizar', [EntrevistaCandidatoController::class, 'finalizarEntrevista'])
            ->name('rrhh.entrevistas.finalizarEntrevista');

        Route::resource('/ofertas', OfertaController::class);
        Route::get('/ofertas/{postulacion}/create', [OfertaController::class, 'createForAPostulacion'])
            ->name('ofertas.createForAPostulacion');
        Route::put('/ofertas/{entrevista}/finalizar', [OfertaController::class, 'decisionCandidato'])
            ->name('ofertas.decisionCandidato');

        Route::resource('/contratos', ContratoController::class);

        Route::resource('/puestos', PuestoController::class);
        Route::resource('/equipos', EquipoController::class);
        Route::resource('/horarios', HorarioController::class);
        Route::resource('/nominas', NominaController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('admision-matriculas')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admision-matriculas.dashboard');
        // Apoderados
        Route::resource('/apoderado', ApoderadoController::class)->middleware('auth');
        //Postulantes
        Route::resource('/postulante', PostulanteController::class)->middleware('auth');
        //Estudiantes
        Route::resource('/alumno', AlumnoController::class)->middleware('auth');
        //Aulas
        Route::resource('/aula', AulaController::class)->middleware('auth');
        //Entrevistas
        Route::resource('/entrevista', EntrevistaController::class)->middleware('auth');
        //Matrícula
        Route::resource('/matricula', MatriculaController::class)->middleware('auth');
        //Admision
        Route::resource('/admision', AdmisionController::class)->middleware('auth');
        //Pagos
        Route::resource('/pago', PagoController::class)->middleware('auth');
        Route::resource('/voucher', VoucherController::class)->middleware('auth');
        //Documentos
        Route::resource('/alumno/docsalumno', DocumentoAlumnoController::class)->middleware('auth');
        Route::resource('/apoderado/docsapoderado', DocumentoApoderadoController::class)->middleware('auth');
        Route::resource('/postulante/docspostulante', DocumentoPostulanteController::class)->middleware('auth');
        Route::resource('/postulante/parentesco',ParentescoController::class)->middleware('auth');
        //Cancel
        Route::get('cancelar/{ruta}', function ($ruta) {
            return redirect()->route($ruta);
        })->middleware('auth')->name('cancelar');
    });
});
// Sistema apoderados
Route::get('/apoderados/register', [ApoderadoController::class, 'crear'])->name('apoderados.crear');
Route::post('/apoderados/register', [ApoderadoController::class, 'registerApoderado'])->name('apoderados.register');

// EVALUACION DESEMPEÑO
Route::prefix('desempeño')->group(function () {
    Route::get('/', function () {
        return view('desempeño-dashboard');
    })->name('desempeño.dashboard');
    // Curso
    Route::resource('cursos', AsignaturaController::class)->names('cursos');
    Route::get('asignar', [AsignaturaController::class, 'indexasignar'])->name('asignar');
    Route::POST('asignarcurso/', [AsignaturaController::class, 'storeasignar'])->name('asignar.grabar');
    Route::get('miscursos/{id}', [AsignaturaController::class, 'miscursosprofesor'])->name('miscursos');
    Route::get('micurso/{id}', [AsignaturaController::class, 'micurso'])->name('micurso');

    // // Silabo
    Route::resource('silabos', SilaboController::class)->names('silabos');


    // Evaluacion
    Route::POST('/evaluacion', [EvaluacionController::class, 'store'])->name('evaluaciones.store');
    Route::put('/evaluaciones/{id}', [EvaluacionController::class, 'update'])->name('evaluaciones.update');
    Route::delete('/evaluaciones/{id}', [EvaluacionController::class, 'destroy'])->name('evaluaciones.destroy');

    // Asistencia
    Route::get('asistencia/{id}', [AsistenciaController::class, 'asistenciaprofesor'])->name('asistencia');
    Route::get('asistencia/{id1}/{id2}', [AsistenciaController::class, 'listaprofesor'])->name('detalleasistencia');
    Route::resource('asistencia', AsistenciaController::class)->names('asistencias');
    Route::get('asistencia/pdf/{id1}/{id2}', [AsistenciaController::class, 'pdf'])->name('listaasistencia.pdf');

    // Calificacion
    Route::get('notas/{id}', [CalificacionController::class, 'registrar'])->name('registrarnotas');
    Route::put('/calificaciones/', [CalificacionController::class, 'update'])->name('calificaciones.update');
    Route::get('miscalificaciones/{id}', [CalificacionController::class, 'calificacionesporalumno'])->name('miscalificaciones');
    Route::get('miscalificaciones/pdf/{id}', [CalificacionController::class, 'pdf'])->name('calificaciones.pdf');

    // Documentos
    Route::get('documentos/', [SilaboController::class, 'mostrardocs'])->name('aprobardocumentos');

    //EvaluarDocentes
    Route::resource('evaluaciondocentes', EvaluacionDocenteController::class)->names('evaluaciondocente');
    Route::get('evaluardocentes/', [EvaluacionDocenteController::class, 'mostrardocentes'])->name('evaluardocentes');
});

// Materiales Escolares
Route::middleware('auth')->group(function () {
    Route::prefix('materiales_escolares')->group(function () {
        Route::get('/', function () {
            return view('materiales_escolares_dashboard');
        })->name('materiales_escolares.dashboard');

        Route::resource('proveedor', ProveedorController::class);
        Route::resource('factura', FacturaController::class);
        Route::resource('material_escolar', MaterialEscolarController::class);
        //Factura_Detalle
        Route::get('/factura/{factura_id}/detalles', [FacturaDetalleController::class, 'index'])->name('factura_detalle.index');
        Route::get('/factura/{factura_id}/detalles/crear', [FacturaDetalleController::class, 'create'])->name('factura_detalle.create');
        Route::get('/factura/{factura_id}/detalles/{id}', [FacturaDetalleController::class, 'show'])->name('factura_detalle.show');
        Route::get('/factura/{factura_id}/detalles/{id}/editar', [FacturaDetalleController::class, 'edit'])->name('factura_detalle.edit');
        Route::post('/factura/{factura_id}/detalles', [FacturaDetalleController::class, 'store'])->name('factura_detalle.store');
        Route::put('/factura/{factura_id}/detalles/{id}', [FacturaDetalleController::class, 'update'])->name('factura_detalle.update');
        Route::delete('/factura/{factura_id}/detalles/{id}', [FacturaDetalleController::class, 'destroy'])->name('factura_detalle.destroy');
    });
});

require __DIR__ . '/auth.php';
