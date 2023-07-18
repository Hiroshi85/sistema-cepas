<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaPsicologica extends Model
{
    use HasFactory;
    protected $table ="prueba_psicologica";
    protected $primaryKey ="id";
    public $timestamps = true;
    protected $fillable = ['nombre', 'tipo_id', 'edad_minima', 'edad_maxima', "psicologo_id", 'online_url', 'file_url'];

    public static function listarPruebas(){
        return PruebaPsicologica::with('psicologo')->with('tipo')->get();
    }

    public static function crearPrueba($nombre, $tipo, $minima, $maxima, $psicologo_id, $online_url, $file_url): PruebaPsicologica {
        return PruebaPsicologica::create([
            'nombre' => $nombre, 
            'tipo_id' =>$tipo,
            'edad_minima' =>$minima,
            'edad_maxima'=>$maxima,
            'psicologo_id'=>$psicologo_id,
            'online_url' =>$online_url,
            'file_url' => $file_url,
        ]);
    }

    public static function actualizarPrueba(string $id, string $nombre, int $tipo, int $minima, 
    int $maxima, $online_url, $file_url): void {
        PruebaPsicologica::where('id', $id)->update([
            'nombre' => $nombre, 
            'tipo_id' =>$tipo,
            'edad_minima' =>$minima,
            'edad_maxima'=>$maxima,
            'online_url' =>$online_url,
            'file_url' => $file_url,
        ]);
    }

    public static function eliminarPrueba(string $id): void {
        PruebaPsicologica::destroy($id);
    }

    public static function buscarPrueba($id){
        return PruebaPsicologica::find($id);
    }

    public function psicologo()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoPrueba::class);
    }
}
