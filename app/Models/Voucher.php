<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $primaryKey = 'idvoucher';
    protected $fillable = ['idpago','fecha_pago', 'monto', 'codigo_operacion', 'voucher', 'observacion', 'estado', 'eliminado'];
    public $timestamps = false;
}
