<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura_Detalle extends Model
{
    use HasFactory;
    protected $table = 'factura_detalle';
    protected $primaryKey = 'factura_detalle_id';
    protected $fillable = [
        'factura_id',
        'material_id',
        'cantidad',
        'precio_unitario'
    ];
    public $timestamps = true;
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
    public function material_escolar()
    {
        return $this->belongsTo(Material_Escolar::class, 'material_id');
    }
}
