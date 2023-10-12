<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use App\Notifications\admision_matriculas\PagoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
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
        $data= request()->validate([
             
        ],[
            
        ]);
     
        $voucher = new Voucher();
        $voucher->idpago = $request->get('idpago');
        $voucher->fecha_pago = $request->get('fecha_pago');
        $voucher->monto = $request->get('monto');
        $voucher->codigo_operacion = $request->get('codigo_operacion');

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
        $autoridad = session()->get('authUser')->hasAnyRole(['admin', 'secretario(a)']);
        $data= request()->validate([
             
        ],[
            
        ]);
        $voucher = Voucher::findOrFail($id);
        
        // $voucher->idpago = $request->get('idpago');
        $voucher->fecha_pago = $request->get('fecha_pago');
        $voucher->monto = $request->get('monto');
        $voucher->codigo_operacion = $request->get('codigo_operacion');

        if($autoridad) { 
            $voucher->observacion = $request->get('observacion');
            $voucher->estado = $request->get('estado');
            if ($voucher->observacion != null){
                $voucher->estado = "Observado";
                $idUserApoderado = Voucher::select("apoderados.idusuario")->
                    join('pagos', 'pagos.idpago', '=', 'vouchers.idpago')
                    ->join('apoderados', 'apoderados.idapoderado', '=', 'pagos.idapoderado')
                    ->first();
                
                $notifiable = User::find($idUserApoderado)->first();
                $notifiable->notify(new PagoNotification($voucher, Auth::user(), "voucher observado"));
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
