<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SesionPrueba extends Model
{
    use HasFactory;

    protected $table ="sesion_prueba";
    protected $primaryKey ="id";
    public $timestamps = true;
    protected $fillable = ['completado','psicologo_id', 'prueba_psicologica_id', 'aula_id'];

    public static function listarSesiones(){
        return SesionPrueba::select('sesion_prueba.id', 'sesion_prueba.completado', 'sesion_prueba.created_at','users.name AS psicologo', 'prueba_psicologica.nombre AS prueba', 'aulas.grado AS grado', 'aulas.seccion AS seccion',
        DB::raw('count(CASE WHEN resultado_prueba.fecha_evaluado is NOT NULL THEN 1 END) as total_evaluados'),
        DB::raw('count(CASE WHEN resultado_prueba.fecha_evaluado is NULL THEN 1 END) as total_no_evaluados'))
        ->join('users', 'sesion_prueba.psicologo_id', 'users.id')
        ->join('prueba_psicologica', 'sesion_prueba.prueba_psicologica_id', 'prueba_psicologica.id')
        ->join('resultado_prueba', 'sesion_prueba.id', 'resultado_prueba.sesion_prueba_id')
        ->join('aulas', 'sesion_prueba.aula_id', 'aulas.idaula')
        ->groupBy('sesion_prueba.id', 'sesion_prueba.completado', 'sesion_prueba.created_at', 'users.name', 'prueba_psicologica.nombre', 'aulas.grado', 'aulas.seccion')
        ->get();
    }

    public static function buscarSesion(int $id){
        return SesionPrueba::find($id);
    }

    public static function obtenerSesion(int $id){
        return SesionPrueba::select('sesion_prueba.id', 'sesion_prueba.completado', 'sesion_prueba.created_at','users.name AS psicologo', 'prueba_psicologica.nombre AS prueba', 'aulas.grado AS grado', 'aulas.seccion AS seccion',
        DB::raw('count(CASE WHEN resultado_prueba.fecha_evaluado is NOT NULL THEN 1 END) as total_evaluados'),
        DB::raw('count(CASE WHEN resultado_prueba.fecha_evaluado is NULL THEN 1 END) as total_no_evaluados'))
        ->join('users', 'sesion_prueba.psicologo_id', 'users.id')
        ->join('prueba_psicologica', 'sesion_prueba.prueba_psicologica_id', 'prueba_psicologica.id')
        ->join('resultado_prueba', 'sesion_prueba.id', 'resultado_prueba.sesion_prueba_id')
        ->join('aulas', 'sesion_prueba.aula_id', 'aulas.idaula')
        ->groupBy('sesion_prueba.id', 'sesion_prueba.completado', 'sesion_prueba.created_at', 'users.name', 'prueba_psicologica.nombre', 'aulas.grado', 'aulas.seccion')
        ->where('sesion_prueba.id', $id)
        ->first();
    }

    public static function crearSesion(int $idpsicologo, int $idprueba, int $idaula): SesionPrueba {
        return SesionPrueba::create([
            'psicologo_id'=>$idpsicologo,
            'prueba_psicologica_id' => $idprueba,
            'aula_id'=>$idaula
        ]);
    }

    public static function actualizarSesion(string $id, int $completado,int $idpsicologo, int $idprueba,): void {
        $sesion = SesionPrueba::buscarSesion($id);
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

    public function resultados()
    {
        return $this->hasMany(ResultadoPrueba::class, 'sesion_prueba_id', 'id');
    }
}
