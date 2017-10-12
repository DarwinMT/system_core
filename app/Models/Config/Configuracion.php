<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
	protected $table = "configuracion";

    protected $primaryKey = "id_conf";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_conf',
        'identificador',
        'id_relacion',
        'valor'
    ];
}
