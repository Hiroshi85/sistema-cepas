<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    use HasFactory;
    protected $table='encuesta';
    protected $primaryKey = 'idencuesta';
    public $timestamps = false;
    protected $fillable=['idalumno','idcurso','estado','fecha','resultados'];

    public function alumno(){
        return $this->hasOne(Alumno::class,'idalumno','idalumno');
    }

    public function cursoasignado(){
        return $this->hasOne(CursoAsignado::class,'iddetalle','idcurso');
    }
}
