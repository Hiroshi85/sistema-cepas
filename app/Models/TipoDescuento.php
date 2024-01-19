<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDescuento extends Model
{
    use HasFactory;
    protected $table = 'tipos_descuento';
    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

}
