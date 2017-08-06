<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
   	protected $table = "modulo";

    protected $primaryKey = "id_men";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_men',
        'id_nodmen',
        'titulo',
        'url',
        'html',
        'estado'
    ];
}
