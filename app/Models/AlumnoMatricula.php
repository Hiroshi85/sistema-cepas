<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoMatricula extends Model
{
    use HasFactory;
    protected $table = 'alumno_matriculas';
    // protected $primaryKey = ['idmatricula','idalumno'];
    protected $fillable = ['idmatricula','idalumno','aula','fecha_registro'];
    public $timestamps = false;
}
