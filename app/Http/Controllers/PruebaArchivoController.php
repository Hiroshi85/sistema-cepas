<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PruebaPsicologica;
use Illuminate\Support\Facades\Storage;

class PruebaArchivoController extends Controller
{
    public function download(string $id)
    {
        $pp = PruebaPsicologica::find($id);
        if(!is_null($pp->file_url)){
            return Storage::download($pp->file_url);
        }
        return abort(404);
    }
}
