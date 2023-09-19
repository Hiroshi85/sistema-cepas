<?php

namespace App\Models\Academia;

use App\Models\Academia\Cursos\Carrera;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitud_academia';

    protected $primaryKey = 'id';

    protected $fillable = ['idalumno', 'observaciones', 'fecha_solicitud', 'estado'];

    public $timestamps = false;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'idalumno', 'idalumno');
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class,'idcarrera','id');
    }

    public function documento()
    {
        return $this->hasOne(DocumentoSolicitud::class, 'idsolicitud');
    }

    public static function listarSolicitudes(
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Solicitud::
        select('solicitud_academia.*', 'alumnos.nombre_apellidos as alumnoNombre', 'alumnos.dni as alumnoDni', 'carreras_unt.nombre as carreraNombre')->
            join('alumnos', 'solicitud_academia.idalumno', '=', 'alumnos.idalumno')->
            join('carreras_unt', 'solicitud_academia.idcarrera', '=', 'carreras_unt.id')->
            where('alumnos.nombre_apellidos', 'LIKE', "%{$search}%")->
            orderBy($sortBy, $sortDirection)

            ->paginate($paginate);
    }
}
