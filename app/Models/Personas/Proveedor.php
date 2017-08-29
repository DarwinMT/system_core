<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
	protected $table = "proveedor";

    protected $primaryKey = "id_prov";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_prov',
        'id_pe',
        'fechaingreso',
        'telefonoprincipal',
        'razonsocial',
        'estado'
    ];
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas\Persona',"id_pe");
    }
}
