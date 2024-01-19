<?php

namespace App\Models\Academia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;
use App\Models\Academia\Cursos\Carrera;


class AlumnoAcademia extends Model
{
    use HasFactory;

    protected $table = 'alumno_academia';

    protected $fillable = [
        'public_id',
        'idalumno',
        'eliminado',
        'idciclo_academico',
        'idcarrera',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'idalumno', 'idalumno');
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class,'idcarrera','id');
    }

}
