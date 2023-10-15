<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $primaryKey = 'idpago';
    protected $fillable = ['idapoderado','concepto','idpostulante','idalumno','fecha_vencimiento','monto','estado', 'eliminado'];
    public $timestamps = false;

    public function vouchers(){
        return $this->hasMany(Voucher::class, 'idpago', 'idpago');
    }

    public function apoderado(){
        return $this->belongsTo(Apoderado::class, 'idapoderado', 'idapoderado');
    }

    public function postulante(){
        return $this->belongsTo(Postulante::class, 'idpostulante', 'idpostulante');
    }

    public function alumno(){
        return $this->belongsTo(Alumno::class, 'idalumno', 'idalumno');
    }
}
