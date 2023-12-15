<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use App\Notifications\admision_matriculas\PagoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VoucherController extends Controller
{
    private function validateVoucher($request, $thisVoucher = null, $update = false){
    
        $rules = [
            'fecha_pago' => 'required|date',
            'codigo_operacion' => 'required|numeric|integer|unique:vouchers,codigo_operacion,'.$thisVoucher.',idvoucher',
            'observacion' => 'string|max:100|nullable',
            //validar voucer como required solo si se trata de un nuevo registro
            'voucher' => ''.!$update  ? 'required' : ''.'|file',
        ];
        if($update)
            $rules['monto_update'] = 'required|numeric|min:0';
        else
            $rules['monto'] = 'required|numeric|min:0';

        $customMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'min' => 'El campo :attribute debe ser mayor o igual a cero.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'unique' => 'El valor del campo :attribute ya existe en la base de datos.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de 100 caracteres.',
            'file' => 'Debe seleccionar un archivo para subir.',
        ];
        $attributes = [
            'fecha_pago' => 'fecha de pago',
            'monto_update' => 'monto',
            'voucher' => 'voucher',
            'observacion' => 'observación',
            'codigo_operacion' => 'código de operación',
        ];

        return $this->validate($request, $rules, $customMessages, $attributes);    
    }
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
        try {
            $data= $this->validateVoucher($request);
        } catch (ValidationException $e) {
            session()->flash(
                'toast',
            [
                'message' => $e->getMessage(),
                'type' => 'error',
            ]
            );
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $voucher = new Voucher();
        $voucher->idpago = $request->get('idpago');
        $voucher->fecha_pago = $request->get('fecha_pago');
        $voucher->monto = $request->get('monto');
        $voucher->codigo_operacion = $request->get('codigo_operacion');
        $voucher->metodo_pago = $request->get('idmetodopago');
        $voucher->observacion = $request->get('observacion');
        if ($request->hasFile('voucher')) {
            $file = $request->file('voucher');
            $path = "assets/img/docs/";
            $time = time().'-'.$file->getClientOriginalName();
            $upload = $request->file('voucher')->move($path, $time);
            $voucher->voucher = $path.$time;
        }
    
        $voucher->estado = "Registrado";
        $voucher->save();

        if(session()->get('authUser')->hasRole('apoderado')){
            //Notify each user with role secretario(a)
            $notifiable = User::role('secretario(a)')->get();
            $notifiable->each->notify(new PagoNotification($voucher, session()->get('authUser'), "voucher registrado"));  
        }

        session()->flash(
            'toast',
            [
                'message' => "Voucher registrado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back()->with('datos','stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $documentoAlumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $documentoAlumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        if($voucher->estado == "Verificado"){
            session()->flash(
                'toast',
                [
                    'message' => "El voucher ya fue verificado, no puede ser modificado",
                    'type' => 'error',
                ]
            );
            return redirect()->back();

        }

        $autoridad = session()->get('authUser')->hasAnyRole(['admin', 'secretario(a)']);
        try{
            $data= $this->validateVoucher($request, $id, true);
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
        
        
        // $voucher->idpago = $request->get('idpago');
        $voucher->fecha_pago = $request->get('fecha_pago');
        $voucher->monto = $request->get('monto_update');
        $voucher->codigo_operacion = $request->get('codigo_operacion');
        $voucher->metodo_pago = $request->get('metodopago_update');

        if($autoridad) { 
            $voucher->observacion = $request->get('observacion');
            $voucher->estado = $request->get('estado');
            //get the apoderado to notify
            $idUserApoderado = $voucher->pago->apoderado->idusuario;
            
            if ($voucher->observacion != null){
                $voucher->estado = "Observado";
                $notifiable = User::find($idUserApoderado);
                $notifiable->notify(new PagoNotification($voucher, Auth::user(), "voucher observado"));
            }
            if($voucher->estado == "Verificado"){
                $voucher->estado = "Verificado";
                $voucher->observacion = null;
                $notifiable = User::find($idUserApoderado);
                $notifiable->notify(new PagoNotification($voucher, Auth::user(), "voucher verificado"));
            }
        }

        if ($request->hasFile('voucher')) {
            $file = $request->file('voucher');
            $path = "assets/img/docs/";
            $time = time().'-'.$file->getClientOriginalName();
            $upload = $request->file('voucher')->move($path, $time);
            $voucher->voucher = $path.$time;
        }

        $voucher->save();
        
        // notify to secretary a voucher was updated
        // idea futura: una vez notificado no debería volver a poderse modificar hasta recibir la aceptación de secretario(a) u otra observación
        if(session()->get('authUser')->hasRole('apoderado')){
            $notifiable = User::role('secretario(a)')->get();
            $notifiable->each->notify(new PagoNotification($voucher, session()->get('authUser'), "voucher actualizado"));
        }

        session()->flash(
            'toast',
            [
                'message' => "Voucher actualizado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back()->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        session()->flash(
            'toast',
            [
                'message' => "Voucher eliminado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back()->with('datos','deleted');
    }
}
