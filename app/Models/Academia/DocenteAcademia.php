<?php

namespace App\Models\Academia;

use App\Models\Academia\Cursos\Carrera;
use App\Models\Rrhh\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteAcademia extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'especialidad_id',
    ];

    protected $table = 'docentes_academia';

    public function especialidad()
    {
        return $this->belongsTo(Carrera::class, 'especialidad_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
