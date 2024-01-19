<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulaciones';

    protected $fillable = [
        'candidato_id',
        'plaza_id',
        'estado',
        'fecha_postulacion',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }

    public function plaza()
    {
        return $this->belongsTo(Plaza::class, 'plaza_id');
    }

    public function evaluacion()
    {
        return $this->hasOne(EvaluacionCandidato::class, 'postulacion_id');
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'postulacion_id');
    }

    // setear estados

    public function setEstadoPendiente()
    {
        $this->estado = 'pendiente';
        $this->save();
    }

    public function setEstadoAprobado()
    {
        $this->estado = 'aprobado';
        $this->save();
    }

    public function setEstadoRechazado()
    {
        $this->estado = 'rechazado';
        $this->save();
    }

    public function setEstadoEnRevision()
    {
        $this->estado = 'en revision';
        $this->save();
    }

    // crud methods
    public static function listarPostulaciones(
        $search = '',
        $sortBy = '',
        $sortDirection = 'asc',
        $paginate = 10
    ) {

        return Postulacion::select('postulaciones.*', 'candidatos.nombre as nombre_candidato', 'puestos.nombre as puesto')
            ->join('candidatos', 'postulaciones.candidato_id', '=', 'candidatos.id')
            ->join('plazas', 'postulaciones.plaza_id', '=', 'plazas.id')
            ->join('puestos', 'plazas.puesto_id', '=', 'puestos.id')
            ->where('candidatos.nombre', 'LIKE', "%{$search}%")
            ->orWhere('puestos.nombre', 'LIKE', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function obtenerTodos()
    {
        return Postulacion::where('estado', '=', 'pendiente')
            ->orderBy('fecha_postulacion', 'asc')->get();
    }

    public static function obtenerPostulacion($id)
    {
        return Postulacion::find($id);
    }

    public static function crearPostulacion($data)
    {
        $postulacion = Postulacion::create($data);
        return $postulacion;
    }

    public static function actualizarPostulacion($postulacion, $data)
    {
        $postulacion->update($data);
        return $postulacion;
    }

    public static function eliminarPostulacion($postulacion)
    {
        $postulacion->delete();
        return $postulacion;
    }

    public static function esMismaPlaza(
        $candidato_id,
        $plaza_id,
        $postulante_id = null
    ) {

        if ($postulante_id != null) {
            return Postulacion::where('candidato_id', $candidato_id)
                ->where('plaza_id', $plaza_id)
                ->where('id', '!=', $postulante_id)
                ->exists();
        }
        return Postulacion::where('candidato_id', $candidato_id)
            ->where('plaza_id', $plaza_id)
            ->exists();
    }

    public static function eliminarPostulacionesDeCandidato($candidato_id)
    {
        $postulaciones = Postulacion::where('candidato_id', $candidato_id)->get();
        foreach ($postulaciones as $postulacion) {
            $postulacion->delete();
        }
    }

    public static function eliminarPostulacionesDePlaza($plaza_id)
    {
        $postulaciones = Postulacion::where('plaza_id', $plaza_id)->get();
        foreach ($postulaciones as $postulacion) {
            $postulacion->delete();
        }
    }
}
