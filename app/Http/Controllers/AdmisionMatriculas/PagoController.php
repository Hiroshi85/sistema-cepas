<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\ApoderadoPostulante;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PagoController extends Controller
{
    private function validatePago($request, $update = false){
        $rules = [
            'fecha_vencimiento' => $update == false ? 'date|after_or_equal:'.now('America/Lima')->toDateString() : 'date',
            'monto_pago' => 'required|numeric|min:0',
            'concepto' => 'required|string|max:100',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'min' => 'El campo :attribute debe ser mayor o igual a cero.',
            'max' => 'El campo :attribute no debe tener.mas de 100 caracteres.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
        ];

        return $this->validate($request, $rules, $messages);
    }

    public function index()
    {
        //if the current user has secretario or admin role
        $autoridad = session()->get('authUser')->hasAnyRole(['secretario(a)', 'director(a)', 'admin']);
        
        $apoderados = null;
        if ($autoridad){
            $apoderados = Apoderado::where('eliminado', 0)->orderBy('nombre_apellidos')->get();
            $pagos = Pago::
                join('apoderados','apoderados.idapoderado','=','pagos.idapoderado')
                ->orderByRaw("CASE estado 
                WHEN 'Pendiente' THEN 1
                WHEN 'Vencido' THEN 2
                WHEN 'Rechazado' THEN 3
                WHEN 'Verificado' THEN 4
                ELSE 5 END")
                ->where('pagos.eliminado', 0)->get();
        }else{
            $pagos = Pago::
                join('apoderados','apoderados.idapoderado','=','pagos.idapoderado')
                ->orderByRaw("CASE estado 
                WHEN 'Pendiente' THEN 1
                WHEN 'Vencido' THEN 2
                WHEN 'Rechazado' THEN 3
                WHEN 'Verificado' THEN 4
                ELSE 5 END")
                ->where('pagos.eliminado', 0)
                ->where('apoderados.idusuario', Auth::user()->id)
                ->get();
        }
        return view('admision-matriculas.pago.index', compact('pagos', 'apoderados'));
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
        try{
            $data = $this->validatePago($request);
        }catch(ValidationException $e){
            session()->flash(
                'toast',
                [
                    'message' => $e->getMessage(),
                    'type' => 'error',
                ]
            );
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $pago = new Pago();
       
        $pago->idapoderado = $request->get('idapoderado');
        if (session()->get('authUser')->hasRole('apoderado')) $pago->idapoderado = Apoderado::where('idusuario', Auth::user()->id)->first()->idapoderado;
        $pago->concepto = $request->get('concepto');
        $pago->monto = $request->get('monto_pago');
        $pago->fecha_vencimiento = $request->get('fecha_vencimiento');
        $pago->estado = "Pendiente";
        $pago->eliminado = 0;
        $pago->save();

        session()->flash(
            'toast',
            [
                'message' => "Pago registrado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('pago.index')->with('datos','stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pago = Pago::findOrFail($id);

        // Validar acceso por usuario 
        $thisApoderado = Apoderado::where('idapoderado', $pago->idapoderado)->first();
        if (!session()->get('authUser')->hasAnyRole(['secretario(a)', 'admin']) && $thisApoderado->idusuario != Auth::user()->id) {
            //return 404 not  found
            abort(404);
        }

        $apoderados = Apoderado::where('eliminado', 0)->orderBy('nombre_apellidos')->get();
        
        $postulantes = ApoderadoPostulante::
            join('postulantes','postulantes.idpostulante','=','apoderado_postulante.idpostulante')
            ->where('idapoderado', $pago->idapoderado)
            ->get();

        $alumnos = Alumno::
            join('postulantes','postulantes.idpostulante','=','alumnos.idpostulante')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->where('apoderado_postulante.idapoderado', $pago->idapoderado)->get();

        //Métodos de pago
        $metodos = MetodoPago::all();

        $vouchers = Voucher::where('eliminado', 0)
            ->where('idpago', $pago->idpago)
            ->get();
        return view('admision-matriculas.pago.edit',compact('pago', 'apoderados', 'alumnos', 'postulantes', 'vouchers', 'metodos'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data= $this->validatePago($request, true);
       
        $idapoderado = $request->get('idapoderado');
        if (session()->get('authUser')->hasRole('apoderado')) $idapoderado = Apoderado::where('idusuario', Auth::user()->id)->first()->idapoderado;
        
        $pago = Pago::findOrFail($id);
        $pago->idapoderado = $idapoderado;
        $pago->concepto = $request->get('concepto');
        
        $pago->monto = $request->get('monto_pago');
        $pago->idpostulante = $request->get('idpostulante');
        $pago->idalumno = $request->get('idalumno');
        $pago->fecha_vencimiento = $request->get('fecha_vencimiento');
        $pago->estado = $request->get('estado');

        session()->flash(
            'toast',
            [
                'message' => "Registro actualizado correctamente",
                'type' => 'success',
            ]
        );
        $pago->save();
        
        return redirect()->route('pago.index')->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idapoderado)
    {
        $pago = Pago::findOrFail($idapoderado);
        $pago->eliminado = 1;
        $pago->save();

        session()->flash(
            'toast',
            [
                'message' => "Registro eliminado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('pago.index')->with('datos','deleted');
    }

    protected function updateMatriculaPagada($pago){
       
        // $alumno = Alumno::where('idpostulante',$postulante->idpostulante)->first(); 
              
        // if( $alumno != null) return;
       
        // $alumno = new Alumno();
        // $alumno->idpostulante = $postulante->idpostulante;
        // $alumno->idaula = $postulante->idaula;
        // $alumno->nombre_apellidos = $postulante->nombre_apellidos;
        // $alumno->fecha_nacimiento = $postulante->fecha_nacimiento;
        // $alumno->dni = $postulante->dni;
        // $alumno->domicilio = $postulante->domicilio;
        // $alumno->numero_celular = $postulante->numero_celular;
        // $alumno->nro_hermanos = $postulante->nro_hermanos;
        // $alumno->estado = "No matriculado";
        // $alumno->save();
    }
}
