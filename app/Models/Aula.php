<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $table = 'aulas';
    protected $primaryKey = 'idaula';
    //grado	seccion	nro_vacantes_total	nro_vacantes_disponibles	eliminado	
    protected $fillable = ['grado', 'seccion', 'nro_vacantes_total', 'nro_vacantes_disponibles', 'eliminado'];
    public $timestamps = false;
}
