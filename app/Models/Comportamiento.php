<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comportamiento extends Model
{
    use HasFactory;
    protected $table ="alumno_conducta";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['alumno_id', 'conducta_id', 'bimestre', "observacion", 'fecha'];

    public function conducta(): BelongsTo
    {
        return $this->belongsTo(Conducta::class);
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }

    public static function crearComportamiento($alumno_id, $conducta_id, $observacion, $fecha, $bimestre): Comportamiento{
        return Comportamiento::create([
            'alumno_id'=>$alumno_id,
            'conducta_id'=>$conducta_id,
            'observacion'=>$observacion,
            'fecha'=>$fecha,
            'bimestre'=>$bimestre,
        ]);
    }

    public static function eliminarComportamiento(string $id): void{
        Comportamiento::destroy($id);
    }

    private function listarComportamientoDeAlumnoPorBimestre(string $id, string $bimestre){
        $comportamientos = Comportamiento::join('alumnos', 'alumno_conducta.alumno_id', '=', 'alumnos.idalumno')
        ->join('conducta', 'alumno_conducta.conducta_id', '=', 'conducta.id')
        ->where('alumnos.idalumno', $id)
        ->where('alumno_conducta.bimestre', $bimestre)
        ->select('alumno_conducta.*','conducta.puntaje', 'conducta.nombre')
        ->get();
        return $comportamientos;
    }
}
