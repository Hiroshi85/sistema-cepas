<?php

namespace App\Models\Academia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'documento_solicitud_academia';

    protected $fillable = [
        'estado',
        'idsolicitud',
        'observaciones',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'idsolicitud');
    }
}
