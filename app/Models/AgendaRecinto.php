<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaRecinto extends Model
{
    use HasFactory;

    protected $table = 'agendarecintos';
    
    protected $fillable = [
        'recinto_id',
        'actividad_id',
    ];
}