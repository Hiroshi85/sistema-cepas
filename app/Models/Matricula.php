<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $table = 'matriculas';
    protected $primaryKey = 'idmatricula';
    protected $fillable = ['año', 'fecha_apertura', 'fecha_cierre', 'tarifa', 'estado', 'eliminado'];
    public $timestamps = false;
}
