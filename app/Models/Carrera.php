<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = "tbl_pensums";

    protected $fillable = [
        'carrera',
        'codigoCarrera',
        'tipoCarrera',
        'departamento',
        'rutaArchivo',
        'estadoArchivo'
    ];
}
