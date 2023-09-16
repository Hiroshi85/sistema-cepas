<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoResultadoPrueba extends Model
{
    use HasFactory;
    protected $table='estado_resultado_prueba';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable=['estado'];
}
