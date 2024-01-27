<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'tbl_directorio';

    protected $fillable = [
        'nombre',
        'tramitesAsignado',
        'correo',
        'contacto'
    ];
}
