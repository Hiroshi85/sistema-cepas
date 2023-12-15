<?php

namespace App\Models\Academia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
