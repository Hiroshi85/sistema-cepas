<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comportamiento extends Model
{
    use HasFactory;
    protected $table ="alumno_conducta";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['alumno_id', 'conducta_id', 'bimestre', "observacion", 'fecha', "sancion_id"];

    public static function getComportamiento(string $id): Comportamiento{
        return Comportamiento::with('conducta')->with('alumno')->with('sancion')->find($id);
    }

    public function conducta(): BelongsTo
    {
        return $this->belongsTo(Conducta::class, 'conducta_id');
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function sancion(): BelongsTo
    {
        return $this->belongsTo(Sancion::class, 'sancion_id');
    }

    public static function crearComportamiento($alumno_id, $conducta_id, $observacion, $fecha, $bimestre, $sancion_id): Comportamiento{
        return Comportamiento::create([
            'alumno_id'=>$alumno_id,
            'conducta_id'=>$conducta_id,
            'observacion'=>$observacion,
            'fecha'=>$fecha,
            'bimestre'=>$bimestre,
            'sancion_id'=>$sancion_id
        ]);
    }

    public static function eliminarComportamiento(string $id): void{
        Comportamiento::destroy($id);
    }

    public static function listarComportamientoDeAlumnoPorBimestre(string $id, string $bimestre){
        $comportamientos = Comportamiento::join('alumnos', 'alumno_conducta.alumno_id', '=', 'alumnos.idalumno')
        ->join('conducta', 'alumno_conducta.conducta_id', '=', 'conducta.id')
        ->leftjoin('sanciones', 'alumno_conducta.sancion_id', '=', 'sanciones.id')
        ->where('alumnos.idalumno', $id)
        ->where('alumno_conducta.bimestre', $bimestre)
        ->select('alumno_conducta.*','conducta.puntaje', 'conducta.nombre', 'sanciones.nombre as sancion')
        ->get();
        return $comportamientos;
    }

    public static function listarComportamientoDeAlumnoAnual(string $id){
        $comportamientos = Comportamiento::join('alumnos', 'alumno_conducta.alumno_id', '=', 'alumnos.idalumno')
        ->join('conducta', 'alumno_conducta.conducta_id', '=', 'conducta.id')
        ->leftjoin('sanciones', 'alumno_conducta.sancion_id', '=', 'sanciones.id')
        ->where('alumnos.idalumno', $id)
        ->select('alumno_conducta.*', 'conducta.puntaje', 'conducta.nombre', 'alumno_conducta.bimestre', 'sanciones.nombre as sancion')
        ->orderBy('alumno_conducta.bimestre', 'asc')
        ->get()
        ->groupBy(function ($item) {
            return $item->bimestre;
        })
        ->map(function ($group) {
            return [
                'resultados' => $group->sortBy('fecha'), // Listado completo ordenado por fecha
                'sumaPuntaje' => $group->sum('puntaje'), // Suma del puntaje en el bimestre
            ];
        });
        return $comportamientos;
    }
}
