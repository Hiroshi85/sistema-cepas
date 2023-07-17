<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrueba extends Model
{
    use HasFactory;
    protected $table ="tipo_prueba";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['tipo'];

    public function prueba()
    {
        return $this->hasMany(PruebaPsicologica::class, 'tipo_id');
    }
}
