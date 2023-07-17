<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducta extends Model
{
    use HasFactory;
    protected $table ="conducta";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['nombre', 'puntaje'];

    public function comportamientos(): HasMany
    {
        return $this->hasMany(Comportamiento::class);
    }
}
