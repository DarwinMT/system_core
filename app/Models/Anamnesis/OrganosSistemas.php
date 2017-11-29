<?php

namespace App\Models\Anamnesis;

use Illuminate\Database\Eloquent\Model;

class OrganosSistemas extends Model
{
	protected $table = "organos_sistemas";

    protected $primaryKey = "id_orgs";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_orgs',
        'id_cone',
        'sentidos_cp',
        'sentidos_sp',
        'respiratorio_cp',
        'respiratorio_sp',
        'vascular_cp',
        'vascular_sp',
        'digestivo_cp',
        'digestivo_sp',
        'genital_cp',
        'genital_sp',
        'urinario_cp',
        'urinario_sp',
        'mesqueletico_cp',
        'mesqueletico_sp',
        'endocrino_cp',
        'endocrino_sp',
        'linfatico_cp',
        'linfatico_sp',
        'nervioso_cp',
        'nervioso_sp',
        'descripcion',
        'estado'
    ];

    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
