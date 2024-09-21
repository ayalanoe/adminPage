<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Croquis extends Model
{
    use HasFactory;

    protected $table = 'tbl_croquis'; //Asosciacion de la tabla con esta variable

    protected $fillable = [
        'nombreArchivo',
        'rutaArchivo',
    ];
}