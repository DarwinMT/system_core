<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rol";

    protected $primaryKey = "id_r";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_r',
        'descripcion',
        'estado'
    ];
}
