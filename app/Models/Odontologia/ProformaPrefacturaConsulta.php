<?php

namespace App\Models\Odontologia;

use Illuminate\Database\Eloquent\Model;

class ProformaPrefacturaConsulta extends Model
{
	protected $table = "proforma_prefactura_consulta";

    protected $primaryKey = "id_prof";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_prof',
        'id_cone',
        'fecha',
        'descripcion',
        'proforma',
        'subtotal',
        'descuento',
        'iva',
        'total',
        'estado',
        'anulado'
    ];
    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
