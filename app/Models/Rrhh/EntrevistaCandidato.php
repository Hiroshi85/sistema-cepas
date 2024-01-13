<?php

namespace App\Models\Rrhh;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrevistaCandidato extends Model
{
    use HasFactory;

    protected $table = 'rrhh_entrevistas';

    protected $fillable = [
        'evaluacion_id',
        'fecha',
        'hora',
        'estado',
        'observaciones',
        'entrevistador_id',
    ];

    protected $cast = [
        'fecha' => 'date',
        'hora' => 'time',
        'estado' => 'string',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionCandidato::class, 'evaluacion_id');
    }

    public function entrevistador()
    {
        return $this->belongsTo(Empleado::class, 'entrevistador_id');
    }

    public function enCurso(): bool
    {
        $fechaEntrevista = $this->fecha . ' ' . $this->hora;
        $fechaHoraEntrevista = Carbon::createFromFormat('Y-m-d H:i:s', $fechaEntrevista);
        $fechaHoraActual = Carbon::now();

        return $fechaHoraEntrevista->lte($fechaHoraActual) && $this->estado === 'pendiente';
    }


    // crud methods

    public static function listarEntrevistas(
        $search = '',
        $sortBy = 'fecha',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return EntrevistaCandidato::select('rrhh_entrevistas.*', 'candidatos.nombre as candidato_nombre', 'puestos.nombre as puesto_nombre', 'empleados.nombre as entrevistador_nombre')
            ->join('rrhh_evaluaciones', 'rrhh_entrevistas.evaluacion_id', '=', 'rrhh_evaluaciones.id')
            ->join('postulaciones', 'rrhh_evaluaciones.postulacion_id', '=', 'postulaciones.id')
            ->join('candidatos', 'postulaciones.candidato_id', '=', 'candidatos.id')
            ->join('plazas', 'postulaciones.plaza_id', '=', 'plazas.id')
            ->join('puestos', 'plazas.puesto_id', '=', 'puestos.id')
            ->join('empleados', 'rrhh_entrevistas.entrevistador_id', '=', 'empleados.id')
            ->with('evaluacion', 'entrevistador')
            ->where('candidatos.nombre', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function crearEntrevista($data)
    {
        return EntrevistaCandidato::create($data);
    }

    public static function obtenerEntrevista($id)
    {
        return EntrevistaCandidato::find($id);
    }

    public static function actualizarEntrevista($id, $data)
    {
        return EntrevistaCandidato::find($id)->update($data);
    }

    public static function eliminarEntrevista($id)
    {
        return EntrevistaCandidato::find($id)->delete();
    }
}
