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

    public static function obtenerResultadoDeAlumnoPDF($sesion_prueba_id, $alumno_id){
        return ResultadoPrueba::where('sesion_prueba_id', $sesion_prueba_id)->where('alumno_id', $alumno_id)
            ->join('sesion_prueba', 'resultado_prueba.sesion_prueba_id', '=', 'sesion_prueba.id')
            ->join('alumnos', 'resultado_prueba.alumno_id', '=', 'alumnos.idalumno')
            ->join('estado_resultado_prueba', 'resultado_prueba.estado_resultado_prueba_id', '=', 'estado_resultado_prueba.id')
            ->join('prueba_psicologica', 'sesion_prueba.prueba_psicologica_id', '=', 'prueba_psicologica.id')
            ->join('aulas', 'sesion_prueba.aula_id', '=', 'aulas.idaula')
            ->select('sesion_prueba.id','prueba_psicologica.nombre', 'sesion_prueba.created_at as fecha_tomada', 'resultado_prueba.fecha_evaluado','alumnos.nombre_apellidos', 'resultado_prueba.puntaje', 'resultado_prueba.observacion', 'resultado_prueba.recomendacion', 'estado_resultado_prueba.estado as estado', 'aulas.grado', 'aulas.seccion')
            ->first();
    }

    public static function obtenerResultadoAnhoAlumnoPDF(string $alumno_id, string $año){
        return ResultadoPrueba::whereYear('sesion_prueba.created_at', '=', $año)
            ->where('alumno_id', $alumno_id)
            ->join('sesion_prueba', 'resultado_prueba.sesion_prueba_id', '=', 'sesion_prueba.id')
            ->join('alumnos', 'resultado_prueba.alumno_id', '=', 'alumnos.idalumno')
            ->join('estado_resultado_prueba', 'resultado_prueba.estado_resultado_prueba_id', '=', 'estado_resultado_prueba.id')
            ->join('prueba_psicologica', 'sesion_prueba.prueba_psicologica_id', '=', 'prueba_psicologica.id')
            ->join('aulas', 'sesion_prueba.aula_id', '=', 'aulas.idaula')
            ->select('sesion_prueba.id','prueba_psicologica.nombre', 'sesion_prueba.created_at as fecha_tomada', 'resultado_prueba.fecha_evaluado', 'resultado_prueba.puntaje', 'resultado_prueba.observacion', 'resultado_prueba.recomendacion', 'estado_resultado_prueba.estado as estado')
            ->get();
    }
}
