<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{
    use HasFactory;

    protected $table = 'recintos'; 

  
    protected $fillable = [
        'nombre',
        'ubicacion',
        'departamento_id',
        'dias_disponibles',
        'h_apertura',
        'h_cierre',
    ];
}