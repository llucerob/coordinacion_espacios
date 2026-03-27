<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'nombre', 
        'f_inicio', 
        'f_fin', 
        'hora_inicio', 
        'hora_fin', 
        'recinto_id'
    ];

    public function recinto()
    {
        return $this->belongsTo(Recinto::class, 'recinto_id');
    }

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'actividad_material')->withPivot('cantidad');
    }
}