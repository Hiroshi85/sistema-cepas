<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AsistenciaXDia extends Model
{
    use HasFactory;
    protected $table ="asistencia";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['fecha', 'tipo_id', 'alumno_id'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoAsistencia::class);
    }

    public static function crearAsistencia($fecha, $tipo_id, $alumno_id): AsistenciaXDia{
        return AsistenciaXDia::create([
            'fecha' => $fecha,
            'tipo_id' => $tipo_id,
            'alumno_id' => $alumno_id,
        ]);
    }

    public static function marcarAsistenciaHoy($alumno_id, $tipo): void{
        $hoy = Carbon::now()->format('Y-m-d');
        AsistenciaXDia::where('alumno_id', $alumno_id)
                    ->where('fecha', $hoy)
                    ->update(['tipo_id'=>$tipo]);
    }

    public static function editarAsistencia($id, $tipo_id): void{
        AsistenciaXDia::where('id', $id)->update([
            'tipo_id' => $tipo_id,
        ]);
    }

    public static function obtenerNumeroAsistenciaHoy(): int{
        return AsistenciaXDia::whereDate('fecha', Carbon::today())->get()->count();
    }

    public static function obtenerNumeroAsistenciaDeAlumno($alumno_id, $fecha): int{
        return AsistenciaXDia::where('alumno_id',$alumno_id)->where('fecha', $fecha)->get()->count();
    }

    public static function obtenerAsistenciaDeAlumno($alumno_id, $fecha): AsistenciaXDia{
        return AsistenciaXDia::where('alumno_id',$alumno_id)->where('fecha', $fecha)->with('tipo')->get();
    }
}
