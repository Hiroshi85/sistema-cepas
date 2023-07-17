<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table='asistencia';
    protected $primaryKey = 'idasistencia';
    public $timestamps = false;
    protected $fillable=['idalumno','idaula','idcurso','bimestre','s1','s3','s3','s4','s5','s6','s7','s8'];

    public function alumno(){
        return $this->hasOne(Alumno::class,'idalumno','idalumno');
    }
}
