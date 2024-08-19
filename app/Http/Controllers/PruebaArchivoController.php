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
            if(str_starts_with($pp->file_url, "psicologia/")){
                $disk = Storage::disk('gcs');
                $tempUrl = $disk->temporaryUrl($pp->file_url, now()->addMinutes(30));
                error_log($tempUrl);
                return redirect($tempUrl);
            }
            return Storage::download($pp->file_url);
        }
        return abort(404);
    }
}
