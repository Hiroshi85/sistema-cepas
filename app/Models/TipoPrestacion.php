<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestacion extends Model
{
    use HasFactory;
    protected $table = 'tipos_prestacion';
    protected $fillable = [
        'nombre'
    ];
    public $timestamps = false;
}
