<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ("admision-matriculas.inbox.index");
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $selectedNotification = DatabaseNotification::find($id);
        $basename = class_basename($selectedNotification->type);
        if($basename == "PagoNotification"){
            $voucher = Voucher::findOrFail($selectedNotification->data["voucher"]['idvoucher']);
            $metodos = MetodoPago::all();
            return view ("admision-matriculas.inbox.index", compact("selectedNotification", "voucher", "metodos"));
        }
        return view ("admision-matriculas.inbox.index", compact("selectedNotification"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
