<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];
    public $timestamps = false;

    public function puestos()
    {
        return $this->hasMany(Puesto::class);
    }

    public static function obtenerTodos()
    {
        return Equipo::orderBy('nombre')->get();
    }

    public static function listarEquipos(
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Equipo::where('nombre', 'LIKE', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function crearEquipo($data)
    {
        $equipo = Equipo::create($data);
        return $equipo;
    }

    public static function actualizarEquipo($equipo, $data)
    {
        $equipo->update($data);
        return $equipo;
    }

    public static function eliminarEquipo($equipo)
    {
        $equipo->delete();
        return $equipo;
    }
}
