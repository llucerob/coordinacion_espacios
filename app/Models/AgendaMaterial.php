<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaMaterial extends Model
{
    use HasFactory;

    protected $table = 'agendamateriales';

    protected $fillable = [
        'material_id',
        'actividad_id',
        'cantidad',
    ];
}