<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedor';
    protected $primaryKey = 'proveedor_id';
    protected $fillable = [
        'correo',
        'direccion',
        'nombre',
        'telefono',
        'dni'
    ];
    public $timestamps = true;
}
