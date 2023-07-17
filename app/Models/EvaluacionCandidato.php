<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionCandidato extends Model
{
    use HasFactory;

    protected $table = 'rrhh_evaluaciones';
    protected $primaryKey = 'id';

    protected $fillable = [
        'postulacion_id',
        'experiencia_laboral',
        'educacion',
        'habilidades',
        'conocimiento_materias',
        'puntaje_total',
    ];

    protected $casts = [
        'educacion' => 'array',
        'habilidades' => 'array',
        'conocimiento_materias' => 'array',
    ];

    public function postulacion()
    {
        return $this->belongsTo(Postulacion::class);
    }

    public function entrevista()
    {
        return $this->hasOne(EntrevistaCandidato::class, 'evaluacion_id');
    }

    // crud methods

    public static function listarEvaluaciones(
        $search = '',
        $sortBy = 'id',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return EvaluacionCandidato::select('rrhh_evaluaciones.*', 'candidatos.nombre as candidato_nombre', 'puestos.nombre as puesto_nombre')
            ->join('postulaciones', 'postulaciones.id', '=', 'rrhh_evaluaciones.postulacion_id')
            ->join('plazas', 'plazas.id', '=', 'postulaciones.plaza_id')
            ->join('candidatos', 'candidatos.id', '=', 'postulaciones.candidato_id')
            ->join('puestos', 'puestos.id', '=', 'plazas.puesto_id')
            ->with('entrevista')
            ->where('candidatos.nombre', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function crearEvaluacion($data)
    {
        return EvaluacionCandidato::create($data);
    }

    public static function actualizarEvaluacion($evaluacion, $data)
    {
        return $evaluacion->update($data);
    }

    public static function eliminarEvaluacion($id)
    {
        $evaluacion = EvaluacionCandidato::find($id);
        return $evaluacion->delete();
    }
}
