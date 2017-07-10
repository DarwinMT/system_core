<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class PersonaEmpresa extends Model
{
	protected $table = "personaempresa";

    protected $primaryKey = "id_peemp";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_peemp',
        'id_pe',
        'id_emp',
        'estado'
    ];
    public function empresa()
    {
        return $this->belongsTo('App\Models\Basico\Empresa',"id_emp");
    }
}
