<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rrhh\StoreNominaRequest;
use App\Models\Rrhh\Descuento;
use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Nomina;
use App\Models\Rrhh\Prestacion;
use App\Models\TipoDescuento;
use App\Models\TipoPrestacion;
use Illuminate\Http\Request;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $nominas = Nomina::orderBy('id', 'desc')->paginate(10);
        return view('rrhh.nominas.index', [
            'nominas' => $nominas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::obtenerEmpleadosVigentes();
        $tipos_prestacion = TipoPrestacion::all();
        $tipos_descuento = TipoDescuento::all();

        $periodos = Nomina::obtenerPeriodos();

        return view('rrhh.nominas.create'
            , [
                'empleados' => $empleados,
                'tipos_prestacion' => $tipos_prestacion,
                'tipos_descuento' => $tipos_descuento,
                'periodos' => $periodos,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNominaRequest $request)
    {
        $nomina = new Nomina(
            [
                'empleado_id' => $request->empleado_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'dias_trabajados' => $request->dias_trabajados,
                'sueldo_basico' => $request->sueldo_basico,
            ]
        );
        $nomina->total_bruto = $nomina->totalBruto();
        $nomina->total_neto = $nomina->totalNeto();
        $nomina->estado_pago = 'pendiente';
        $nomina->fecha_pago = Date('Y-m-d');
        $nomina->save();

        // guardar prestaciones
        foreach ($request->prestaciones as $prestacionData) {
            $prestacion = Prestacion::create([
                'nomina_id' => $nomina->id,
                'tipo_prestacion_id' => $prestacionData['tipo_prestacion_id'],
                'monto' => $prestacionData['monto'],
            ]);
            // agregar a la nomina
            $nomina->prestaciones()->save($prestacion);
        }
        // guardar descuentos
        foreach ($request->descuentos as $descuentoData) {
            $descuento = Descuento::create([
                'nomina_id' => $nomina->id,
                'tipo_descuento_id' => $descuentoData['tipo_descuento_id'],
                'monto' => $descuentoData['monto'],
            ]);
            // agregar a la nomina
            $nomina->descuentos()->save($descuento);
        }

        session()->flash(
            'toast',
            [
                'message' => "Nómina del empleado {$nomina->empleado->nombre} generada correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('nominas.index')->with('success', 'Nómina creada exitosamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Nomina $nomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nomina $nomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nomina $nomina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nomina $nomina)
    {
        //
    }
}
