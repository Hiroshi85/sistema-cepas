<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function actualizarResultado(string $id, string $puntaje, string $observacion, string $recomendacion, int $estado_resultado_prueba_id, date $fecha_evaluado){
        $resultado = ResultadoPrueba::buscarResultado($id);
        $resultado->puntaje = $puntaje;
        $resultado->observacion = $observacion;
        $resultado->recomendacion = $recomendacion;
        $resultado->estado_resultado_prueba_id = $estado_resultado_prueba_id;
        if($resultado->fecha_evaluado == null) $resultado->fecha_evaluado = $fecha_evaluado;
        $resultado->save();
    }

    public static function buscarResultado($id){
        return ResultadoPrueba::find($id);
    }

    public static function listarResultadosDeSesion($sesion_prueba_id){
        return ResultadoPrueba::where('sesion_prueba_id', $sesion_prueba_id)
            ->with('sesion')->with('alumno')->with('estado')
            ->get();
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
