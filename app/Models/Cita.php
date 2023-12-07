<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Cita extends Model
{
    use HasFactory;
    protected $table = 'citas';
    protected $primaryKey = 'id';
    protected $fillable = ['alumno_id','apoderado_id','citador_id','motivo','esCancelado','fueRealizado','fechaHoraInicio','fechaHoraFin','duracionMinutos'];
    public $timestamps = true;

    public static function listarCitas(int $idCitador = 0){
        if($idCitador){
            return Cita::join('alumnos as al', 'citas.alumno_id', 'al.idalumno')
            ->join('aulas as au', 'al.idaula', 'au.idaula')
            ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
            ->join('users as u', 'citas.citador_id', 'u.id')
            ->select('citas.id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','motivo', 'esCancelado', 'fueRealizado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos', 'grado', 'seccion')
            ->where('citas.citador_id', $idCitador)
            ->get();
        }

        return Cita::join('alumnos as al', 'citas.alumno_id', '=', 'al.idalumno')
        ->join('aulas as au', 'al.idaula', 'au.idaula')
        ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
        ->join('users as u', 'citas.citador_id', 'u.id')
        ->select('citas.id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','motivo', 'esCancelado', 'fueRealizado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos', 'grado', 'seccion')
        ->get();
    }

    public static function getCitaById(string $id): Cita{
        return Cita::join('alumnos as al', 'citas.alumno_id', '=', 'al.idalumno')
        ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
        ->join('users as u', 'citas.citador_id', 'u.id')
        ->join('aulas as a', 'al.idaula', 'a.idaula')
        ->select('citas.id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','a.grado','a.seccion','motivo', 'esCancelado', 'fueRealizado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos')
        ->where('citas.id', $id)
        ->first();
    }

    public static function crearCita(string $alumno_id, string $apoderado_id, string $citador_id, string $motivo, bool $esCancelado, $fueRealizado, string $fechaHoraInicio, string $fechaHoraFin, string $duracion): Cita{
        return Cita::create([
            'alumno_id' => $alumno_id,
            'apoderado_id' => $apoderado_id,
            'citador_id' => $citador_id,
            'motivo' => $motivo,
            'esCancelado' => $esCancelado,
            'fueRealizado' => $fueRealizado,
            'fechaHoraInicio' => $fechaHoraInicio,
            'fechaHoraFin' => $fechaHoraFin,
            'duracionMinutos' => $duracion,
        ]);
    }

    public static function actualizarCita(string $id, string $alumno_id, string $apoderado_id, string $citador_id, string $motivo, bool $esCancelado, bool $fueRealizado, string $fechaHoraInicio, string $fechaHoraFin, int $duracion): void{
        Cita::where('id', $id)->update([
            'alumno_id' => $alumno_id,
            'apoderado_id' => $apoderado_id,
            'citador_id' => $citador_id,
            'motivo' => $motivo,
            'esCancelado' => $esCancelado,
            'fueRealizado' => $fueRealizado,
            'fechaHoraInicio' => $fechaHoraInicio,
            'fechaHoraFin' => $fechaHoraFin,
            'duracionMinutos' => $duracion,
        ]);
    }

    public static function cancelarCita(string $id, bool $esCancelado){
        Cita::where('id', $id)->update([
            'esCancelado' => $esCancelado,
            'fueRealizado' => false
        ]);
    }

    public static function eliminarCita(string $id): void{
        Cita::destroy($id);
    }

    public function getFechaHoraInicioAttribute($date){
        return Carbon::parse($date);
    }

    public function getFechaHoraFinAttribute($date){
        return Carbon::parse($date);
    }
}
