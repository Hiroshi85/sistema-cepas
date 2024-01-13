<?php

namespace App\Models;

use App\Models\Rrhh\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CursoAsignado extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table='detallecurso';
    protected $primaryKey = 'iddetalle';
    public $timestamps = false;
    protected $fillable=['idcurso', 'idaula', 'iddocente','horario','estado'];

    public function curso(){
        return $this->hasOne(Asignatura::class,'id','idcurso');
    }

    public function aula(){
        return $this->hasOne(Aula::class,'idaula','idaula');
    }

    public function docente(){
        return $this->hasOne(Empleado::class,'id','iddocente');
    }

    public function silabo(){
        return $this->hasOne(Silabo::class,'idcurso','idcurso');
    }

    public function evaluacion(){
        return $this->hasOne(Evaluacion::class,'idcurso','idcurso');
    }

    public function calificacion(){
        return $this->hasMany(Calificacion::class,'idcurso','iddetalle');
    }

}
