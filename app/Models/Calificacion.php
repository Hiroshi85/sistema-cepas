<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table='calificacion';
    protected $primaryKey = 'idcalificacion';
    public $timestamps = false;
    protected $fillable=['idalumno','idcurso','b1','b2','b3','b4','prom'];

    public function alumno(){
        return $this->hasOne(Alumno::class,'idalumno','idalumno');
    }

    public function cursoasignado(){
        return $this->hasOne(CursoAsignado::class,'iddetalle','idcurso');
    }
}
