<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Plaza;
use App\Models\Postulacion;
use App\Models\Candidato;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PostulacionController extends Controller
{

    use ValidatesRequests;
    protected function rulesWithOutCandidato()
    {
        return [
            'plaza_id' => 'required|exists:plazas,id',
            'fecha_postulacion' => 'required|date|after_or_equal:today'
        ];
    }

    protected function rules()
    {
        return [
            'candidato_id' => 'required|exists:candidatos,id',
            'plaza_id' => 'required|exists:plazas,id',
            'fecha_postulacion' => 'required|date|after_or_equal:today'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        Request $request
    ) {
        $mode =  $request->input('mode');
        return view('postulaciones.index', compact('mode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('postulaciones.create', ['candidatos' => Candidato::obtenerTodos(), 'plazas' => Plaza::obtenerPlazasActivas()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $request->validate($this->rulesWithOutCandidato());
        // if candidato_id is set and nombre, email and dni are set, return error
        if ($request->input('candidato_id') != null && ($request->input('nombre') != null || $request->input('email') != null || $request->input('dni') != null)) {
            session()->flash('toast', [
                'message' => 'Tienes que deseleccionar el candidato para crear uno nuevo',
                'type' => 'error',
            ]);
            return redirect()->route('postulaciones.create')->withInput();
        }
        // if candidato_id is null, create a new candidato
        if ($request->input('candidato_id') == null) {
            $data_candidato = $request->validate(CandidatoController::rules(), CandidatoController::messages());
            $candidato_new = Candidato::crearCandidato($data_candidato);
            $request['candidato_id'] = $candidato_new->id;
        }

        $data = $this->validate($request, $this->rules());


        // validar que no se postule a la misma plaza
        if (Postulacion::esMismaPlaza(
            $data['candidato_id'],
            $data['plaza_id']
        )) {
            session()->flash('toast', [
                'message' => 'El candidato ya se encuentra postulado a esta plaza',
                'type' => 'error',
            ]);
            return redirect()->route('postulaciones.create')->withInput();
        }

        Postulacion::crearPostulacion($data);

        session()->flash('toast', [
            'message' => 'Postulación añadida correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('postulaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postulacion $postulacion)
    {
        return view('postulaciones.show', ['postulacion' => $postulacion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postulacion $postulacion)
    {
        // devolver solo las plazas cuya fecha de inicio ya haya pasado
        return view(
            'postulaciones.edit',
            [
                'postulacion' => $postulacion,
                'candidatos' => Candidato::obtenerTodos(),
                'plazas' => Plaza::obtenerPlazasActivas()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postulacion $postulacion)
    {
        date_default_timezone_set('America/Lima');
        // if candidato_id is null, create a new candidato
        $data = $this->validate($request, $this->rules());
        // validar que no se postule a la misma plaza excepto si es la misma postulacion
        if (Postulacion::esMismaPlaza(
            $data['candidato_id'],
            $data['plaza_id'],
            $postulacion->id
        )) {
            session()->flash('toast', [
                'message' => 'El candidato ya se encuentra postulado a esta plaza',
                'type' => 'error',
            ]);
            return redirect()->route('postulaciones.edit', $postulacion->id)->withInput();
        }


        Postulacion::actualizarPostulacion($postulacion, $data);

        session()->flash('toast', [
            'message' => 'Postulación actualizada correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('postulaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postulacion $postulacion)
    {
        Postulacion::eliminarPostulacion($postulacion);
        session()->flash('toast', [
            'message' => 'Postulación eliminada correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('postulaciones.index');
    }

    public function destroyByCandidato(Candidato $candidato)
    {
        Postulacion::eliminarPostulacionesDeCandidato($candidato->id);
        session()->flash('toast', [
            'message' => 'Postulaciones eliminadas correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('postulaciones.index', ['mode' => 'candidato']);
    }
    public function destroyByPlaza(Plaza $plaza)
    {
        Postulacion::eliminarPostulacionesDePlaza($plaza->id);
        session()->flash('toast', [
            'message' => 'Postulaciones eliminadas correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('postulaciones.index', ['mode' => 'plaza']);
    }

    public function loadSinglePdf(Request $req)
    {
        $postulacion = Postulacion::obtenerPostulacion($req->postulacion);
        $pdf = Pdf::loadView('postulaciones.pdf.show', compact('postulacion'));
        return $pdf->stream('postulacion.pdf');
    }
}
