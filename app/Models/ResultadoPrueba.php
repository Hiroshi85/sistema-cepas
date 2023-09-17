<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Datetime;
class ResultadoPrueba extends Model
{
    use HasFactory;
    protected $table ="resultado_prueba";
    protected $primaryKey ="sesion_prueba_id";
    public $timestamps = false;
    protected $fillable = ['sesion_prueba_id', 'alumno_id', 'puntaje', 'observacion', 'recomendacion' , 'estado_resultado_prueba_id', 'fecha_evaluado'];

    public static function crearResultado($sesion_prueba_id, $alumno_id): ResultadoPrueba {
        return ResultadoPrueba::create([
            'sesion_prueba_id'=>$sesion_prueba_id,
            'alumno_id'=>$alumno_id,
        ]);
    }

    public static function actualizarResultado(string $id, string $alumno_id, float $puntaje, string $observacion, string $recomendacion, string $estado_resultado_prueba_id, Datetime $fecha_evaluado){
        $resultado = ResultadoPrueba::buscarResultado($id, $alumno_id);
        ResultadoPrueba::where('sesion_prueba_id', $id)->where('alumno_id', $alumno_id)
        ->update(['puntaje'=> $puntaje,
            'observacion'=> $observacion,
            'recomendacion'=> $recomendacion,
            'estado_resultado_prueba_id'=> $estado_resultado_prueba_id
        ]);
        if($resultado->fecha_evaluado == null){
            ResultadoPrueba::where('sesion_prueba_id', $id)->where('alumno_id', $alumno_id)
            ->update(['fecha_evaluado' => $fecha_evaluado]);
        }
    }

    public static function buscarResultado($id, $alumno_id){
        return ResultadoPrueba::where('sesion_prueba_id', $id)->where('alumno_id', $alumno_id)->first();
    }

    public static function listarResultadosDeSesion($sesion_prueba_id){
        return ResultadoPrueba::where('sesion_prueba_id', $sesion_prueba_id)
            ->with('sesion')->with('alumno')->with('estado')
            ->get();
    }

    public static function obtenerResultadoDeAlumno($sesion_prueba_id, $alumno_id){
        return ResultadoPrueba::where('sesion_prueba_id', $sesion_prueba_id)->where('alumno_id', $alumno_id)
            ->with('sesion')->with('alumno')->with('estado')
            ->first();
    }

    public static function eliminarResultadosPorSesion($id){
        ResultadoPrueba::where('sesion_prueba_id', $id)->delete();
    }

    public function sesion()
    {
        return $this->belongsTo(SesionPrueba::class, 'sesion_prueba_id');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id', 'idalumno');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoResultadoPrueba::class, 'estado_resultado_prueba_id', 'id');
    }
}
