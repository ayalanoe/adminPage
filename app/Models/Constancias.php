<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constancias extends Model
{
    use HasFactory;

    protected $table = 'tbl_constancias'; 

    protected $fillable = [
        'tipoConstancia',
        'fechaRegistro',
    ];
}