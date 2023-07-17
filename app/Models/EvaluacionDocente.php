<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EvaluacionDocente extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table='evaluacion_docente';
    protected $primaryKey = 'idevadoc';
    public $timestamps = false;
    protected $fillable=['iddocente','calificacion','retroalimentacion'];

    public function docente(){
        return $this->hasOne(Empleado::class,'id','iddocente');
    }
}
