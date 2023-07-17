<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table='evaluacion';
    protected $primaryKey = 'idevaluacion';
    public $timestamps = false;
    protected $fillable=['namefile','idcurso'];

    public function cursoasignado(){
        return $this->hasOne(CursoAsignado::class,'idcurso','idcurso');
    }

}
