<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $table = "permisos";

    protected $primaryKey = "id_per";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_per',
        'id_u',
        'id_r',
        'acceso',
        'estado'
    ];
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario\Usuario',"id_u");
    }
    public function rol()
    {
        return $this->belongsTo('App\Models\Usuario\Rol',"id_r");
    }
}
