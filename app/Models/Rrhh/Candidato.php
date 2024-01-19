<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dni',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'telefono',
        'email',
        'curriculum_url',
    ];

    public function edad()
    {
        $fechaNacimiento = new \DateTime($this->fecha_nacimiento);
        $hoy = new \DateTime();
        $edad = $hoy->diff($fechaNacimiento);
        return $edad->y;
    }

    public function postulaciones(): HasMany
    {
        return $this->hasMany(Postulacion::class, 'candidato_id');
    }

    public static function listarCandidatos(
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Candidato::where('nombre', 'LIKE', "%{$search}%")
            ->orWhere('dni', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('telefono', 'LIKE', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function obtenerTodos()
    {
        return Candidato::orderBy('nombre', 'asc')->get();
    }

    public static function listarCandidatosConPostulaciones(
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Candidato
            ::has('postulaciones')
            ->where('nombre', 'LIKE', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->with(['postulaciones' => function ($query) {
                $query->orderBy('fecha_postulacion', 'desc');
            }])
            ->paginate($paginate);
    }

    public static function crearCandidato($data)
    {
        $candidato = Candidato::create($data);
        return $candidato;
    }

    public static function actualizarCandidato($candidato, $data)
    {
        $candidato->update($data);
        return $candidato;
    }

    public static function eliminarCandidato($candidato)
    {
        $candidato->delete();
        return $candidato;
    }
}
