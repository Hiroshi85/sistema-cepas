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
    protected $fillable = ['alumno_id','apoderado_id','citador_id','motivo','fechaHoraInicio','fechaHoraFin','duracionMinutos', 'estado'];
    public $timestamps = true;

    public static function listarCitas(int $idCitador = 0){
        if($idCitador){
            return Cita::join('alumnos as al', 'citas.alumno_id', 'al.idalumno')
            ->join('aulas as au', 'al.idaula', 'au.idaula')
            ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
            ->join('users as u', 'citas.citador_id', 'u.id')
            ->select('citas.id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','motivo', 'citas.estado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos', 'grado', 'seccion')
            ->where('citas.citador_id', $idCitador)
            ->get();
        }

        return Cita::join('alumnos as al', 'citas.alumno_id', '=', 'al.idalumno')
        ->join('aulas as au', 'al.idaula', 'au.idaula')
        ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
        ->join('users as u', 'citas.citador_id', 'u.id')
        ->select('citas.id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','motivo', 'citas.estado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos', 'grado', 'seccion')
        ->get();
    }

    public static function getCitaById(string $id): Cita{
        return Cita::join('alumnos as al', 'citas.alumno_id', '=', 'al.idalumno')
        ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
        ->join('users as u', 'citas.citador_id', 'u.id')
        ->join('aulas as a', 'al.idaula', 'a.idaula')
        ->select('citas.id', 'alumno_id', 'apoderado_id', 'u.id as citador_id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','a.grado','a.seccion','motivo', 'citas.estado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos')
        ->where('citas.id', $id)
        ->first();
    }

    public static function crearCita(string $alumno_id, string $apoderado_id, string $citador_id, string $motivo, string $fechaHoraInicio, string $fechaHoraFin, string $duracion): Cita{
        return Cita::create([
            'alumno_id' => $alumno_id,
            'apoderado_id' => $apoderado_id,
            'citador_id' => $citador_id,
            'motivo' => $motivo,
            'fechaHoraInicio' => $fechaHoraInicio,
            'fechaHoraFin' => $fechaHoraFin,
            'duracionMinutos' => $duracion,
        ]);
    }

    public static function actualizarCita(string $id, string $alumno_id, string $apoderado_id, string $citador_id, string $motivo, string $estado , string $fechaHoraInicio, string $fechaHoraFin, int $duracion): void{
        Cita::where('id', $id)->update([
            'alumno_id' => $alumno_id,
            'apoderado_id' => $apoderado_id,
            'citador_id' => $citador_id,
            'motivo' => $motivo,
            'estado' => $estado,
            'fechaHoraInicio' => $fechaHoraInicio,
            'fechaHoraFin' => $fechaHoraFin,
            'duracionMinutos' => $duracion,
        ]);
    }

    public static function eliminarCita(string $id): void{
        Cita::where('id', $id)->delete();
    }

    public function getFechaHoraInicioAttribute($date){
        return Carbon::parse($date);
    }

    public function getFechaHoraFinAttribute($date){
        return Carbon::parse($date);
    }

    public static function getCitasHoy(string $idUser){
        $citas = Cita::join('alumnos as al', 'citas.alumno_id', '=', 'al.idalumno')
        ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
        ->join('users as u', 'citas.citador_id', 'u.id')
        ->join('aulas as a', 'al.idaula', 'a.idaula')
        ->select('citas.id', 'alumno_id', 'apoderado_id', 'u.id as citador_id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','a.grado','a.seccion','motivo', 'citas.estado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos')
        ->where('citas.estado', 'programado')
        ->whereDate('fechaHoraInicio', Carbon::today())
        ->orderBy('fechaHoraInicio', 'asc');

        if($idUser){
            $citas = $citas->where('citas.citador_id', $idUser);
        }

        return $citas->get();
    }

    public static function getCitasSemana(string $idUser){
        $ultimoDia = Carbon::now()->endOfWeek();
        $manhana = Carbon::tomorrow();

        $citas = Cita::join('alumnos as al', 'citas.alumno_id', '=', 'al.idalumno')
        ->join('apoderados as ap', 'citas.apoderado_id', 'ap.idapoderado')
        ->join('users as u', 'citas.citador_id', 'u.id')
        ->join('aulas as a', 'al.idaula', 'a.idaula')
        ->select('citas.id', 'alumno_id', 'apoderado_id', 'u.id as citador_id', 'al.nombre_apellidos as alumno', 'u.name as citador', 'ap.nombre_apellidos as apoderado','ap.numero_celular','a.grado','a.seccion','motivo', 'citas.estado', 'fechaHoraInicio', 'fechaHoraFin', 'duracionMinutos')
        ->whereBetween('fechaHoraInicio', [$manhana, $ultimoDia])
        ->where('citas.estado', 'programado')
        ->orderBy('fechaHoraInicio', 'asc');

        if($idUser){
            $citas = $citas->where('citas.citador_id', $idUser);
        }

        return $citas->get();
    }


}
