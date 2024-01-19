<?php

namespace App\Models\Academia;

use App\Models\Academia\Cursos\Carrera;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;
use Illuminate\Support\Facades\Log;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitud_academia';

    protected $primaryKey = 'id';

    protected $fillable = ['idalumno', 'observaciones', 'fecha_solicitud', 'estado','idcarrera', 'idciclo_academico', 'public_id'];

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

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }

}
