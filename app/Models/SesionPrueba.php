<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionPrueba extends Model
{
    use HasFactory;

    protected $table ="sesion_prueba";
    protected $primaryKey ="id";
    public $timestamps = true;
    protected $fillable = ['completado','psicologo_id', 'prueba_psicologica_id', 'aula_id'];

    public static function listarSesiones(){
        return SesionPrueba::with('psicologo')->with('prueba_psicologica')->with('aula')->get();
    }

    public static function buscarPrueba(int $id){
        return SesionPrueba::find($id);
    }

    public static function crearSesion(int $idpsicologo, int $idprueba, int $idaula): SesionPrueba {
        return SesionPrueba::create([
            'psicologo_id'=>$idpsicologo,
            'prueba_psicologica_id' => $idprueba,
            'aula_id'=>$idaula
        ]);
    }

    public static function actualizarSesion(string $id, int $completado,int $idpsicologo, int $idprueba,): void {
        $sesion = SesionPrueba::buscarPrueba($id);
        $sesion->completado = $completado;
        $sesion->psicologo_id = $idpsicologo;
        $sesion->prueba_psicologica_id = $idprueba;
        $sesion->save();
    }

    public static function eliminarSesion(string $id): void {
        SesionPrueba::destroy($id);
    }

    public function psicologo()
    {
        return $this->belongsTo(User::class);
    }

    public function prueba_psicologica()
    {
        return $this->belongsTo(PruebaPsicologica::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}
