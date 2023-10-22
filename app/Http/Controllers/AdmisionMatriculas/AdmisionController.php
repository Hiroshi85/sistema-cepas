<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Admision;
use App\Models\PostulanteAdmision;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdmisionController extends Controller
{
    private function validateAdmision(Request $request)
    {
        $year = date('Y');
        $startDate = "{$year}-01-01";
        $endDate = "{$year}-12-31";

        return [
            'fecha_apertura' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($year, $startDate, $endDate) {
                    if ($value < $startDate || $value > $endDate) {
                        $fail("La fecha de apertura debe estar dentro del rango del año actual ({$year}).");
                    }
                },
            ],
            'fecha_cierre' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $year, $startDate, $endDate) {
                    if ($value < $startDate || $value > $endDate) {
                        $fail("La fecha de cierre debe estar dentro del rango del año actual ({$year}).");
                    }

                    $fechaApertura = $request->input('fecha_apertura');
                    if ($value < $fechaApertura) {
                        $fail("La fecha de cierre no puede ser menor a la fecha de apertura.");
                    }
                },
            ],
            'tarifa' => 'required|numeric|min:0', //floating numbers
            'estado' => 'required',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validateAdmision($request));
        $data['año'] = date('Y', strtotime($request->get('fecha_apertura')));
        Admision::create($data);
        return redirect()->back()->with('datos','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admision $admision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admision $admision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idadmision)
    {
        $data = $request->validate($this->validateAdmision($request));        
        $admision = Admision::findOrFail($idadmision);
        $admision->update($data);
        return redirect()->back()->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admision $admision)
    {
        //
    }

    public function loadSinglePdf($id)
    {
        //Only report status Acetado or Rechazado
        $admision = Admision::findOrFail($id);
        $resultados = PostulanteAdmision::where('idadmision', $id)
            ->join('postulantes', 'postulantes.idpostulante', 'postulante_admision.idpostulante')
            ->join('aulas','aulas.idaula','postulantes.idaula')
            ->orderByRaw("postulantes.estado, grado, seccion, nombre_apellidos")
            ->whereRaw('resultado = "Aceptado" OR resultado = "Rechazado"')
            ->get();
        $pdf = Pdf::loadView('admision-matriculas.admision.pdf.show', compact('admision','resultados'));
        return $pdf->stream('resultados-'.$admision->año.'.pdf');
    }
}
