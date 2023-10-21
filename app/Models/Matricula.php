<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $table = 'matriculas';
    protected $primaryKey = 'idmatricula';
    protected $fillable = ['año', 'fecha_apertura', 'fecha_cierre', 'tarifa', 'estado','total_alumnos', 'eliminado'];
    public $timestamps = false;

    public function alumno_matriculas(){
        return $this->hasMany(AlumnoMatricula::class, 'idmatricula', 'idmatricula');
    }
}
