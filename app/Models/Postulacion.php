<?php

namespace App\Models;

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
