<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;
    protected $table = 'metodo_pago';
    protected $primaryKey = 'idmetodopago';
    protected $fillable = ['metodo', 'propietario', 'tipo', 'numero'];
    public $timestamps = false;
}
