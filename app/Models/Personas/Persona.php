<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	protected $table = "persona";

    protected $primaryKey = "id_pe";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_pe',
        'ci',
        'nombre',
        'apellido',
        'avatar',
        'genero',
        'fechan',
        'direccion',
        'email',
        'estado'
    ];
    public function personaempresa()
    {
        return $this->hasMany('App\Models\Personas\PersonaEmpresa',"id_pe");
    }

}
