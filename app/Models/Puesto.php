<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'equipo_id',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function plazas()
    {
        return $this->hasMany(Plaza::class);
    }

    public function esDocente()
    {
        return $this->equipo_id == 4;
    }

    public static function listarPuestos(
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Puesto::select('puestos.*', 'equipos.nombre as equipo')
            ->where('puestos.nombre', 'LIKE', "%{$search}%")
            ->join('equipos', 'puestos.equipo_id', '=', 'equipos.id')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function crearPuesto($data)
    {
        $puesto =  Puesto::create($data);
        return $puesto;
    }

    public static function obtenerTodos()
    {
        return Puesto::orderBy('nombre', 'asc')->get();
    }

    public static function actualizarPuesto($puesto, $data)
    {
        $puesto->update($data);
        return $puesto;
    }

    public static function eliminarPuesto($puesto)
    {
        $puesto->delete();
        return $puesto;
    }
}
