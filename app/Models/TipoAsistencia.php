<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAsistencia extends Model
{
    use HasFactory;
    protected $table ="tipo_asistencia";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['descripcion'];

    public function asistencia()
    {
        return $this->hasMany(Asistencia::class, 'tipo_id');
    }
}
