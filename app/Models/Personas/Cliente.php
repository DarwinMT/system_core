<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";

    protected $primaryKey = "id_cli";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_cli,',
        'id_pe',
        'numerohistoria',
        'fecharegistro',
        'direcciontrabajo',
        'telefonotrabajo',
        'telefonodomicilio',
        'estado'
    ];
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas\Persona',"id_pe");
    }
}
