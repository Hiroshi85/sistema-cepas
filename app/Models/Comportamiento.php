<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comportamiento extends Model
{
    use HasFactory;
    protected $table ="alumno_conducta";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['alumno_id', 'conducta_id', 'bimestre', "observacion", 'fecha'];

    public function conducta(): BelongsTo
    {
        return $this->belongsTo(Conducta::class);
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }
}
