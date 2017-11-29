<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = "empresa";

    protected $primaryKey = "id_emp";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_emp',
        'id_sucn',
        'id_ci',
        'nombre',
        'direccion',
        'telefono',
        'tipo',
        'ruc',
        'logo',
        'estado',
        'jerarquia'
    ];

    public function ciudad()
    {
        return $this->belongsTo('App\Models\Basico\Ciudad',"id_ci");
    }

}
