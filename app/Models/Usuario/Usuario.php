<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuario";

    protected $primaryKey = "id_u";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_u',
        'id_pe',
        'username',
        'password',
        'estado'
    ];
}
