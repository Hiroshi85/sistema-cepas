<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        'postulacion_id',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'salario',
        'beneficios',
        'estado',
        'contrato_fecha_inicio',
        'meses_contrato'
    ];

    protected $casts = [
        'beneficios' => 'array'
    ];

    public function postulacion(): BelongsTo
    {
        return $this->belongsTo(Postulacion::class, 'postulacion_id');
    }

    // crud methods
    public static function listarOfertas(
        $search = '',
        $sortBy = 'fecha_inicio',
        $sortDirection = 'desc',
        $paginate = 10
    ) {
        return Oferta::select('ofertas.*', 'candidatos.nombre as candidato', 'puestos.nombre as puesto')
            ->join('postulaciones', 'postulaciones.id', '=', 'ofertas.postulacion_id')
            ->join('candidatos', 'candidatos.id', '=', 'postulaciones.candidato_id')
            ->join('plazas', 'plazas.id', '=', 'postulaciones.plaza_id')
            ->join('puestos', 'puestos.id', '=', 'plazas.puesto_id')
            ->where('candidatos.nombre', 'like', '%' . $search . '%')
            ->orWhere('puestos.nombre', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function crearOferta($data)
    {
        return Oferta::create($data);
    }

    public static function obtenerOferta($id)
    {
        return Oferta::find($id);
    }

    public static function obtenerTodo()
    {
        return Oferta::orderBy('fecha_inicio', 'desc')->get();
    }

    public static function actualizarOferta($id, $data)
    {
        $oferta = Oferta::find($id);
        Oferta::where('id', $id)->update($data);
        return $oferta;
    }

    public static function eliminarOferta($oferta)
    {
        return $oferta->delete();
    }
}
