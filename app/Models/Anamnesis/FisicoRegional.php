<?php

namespace App\Models\Anamnesis;

use Illuminate\Database\Eloquent\Model;

class FisicoRegional extends Model
{
	protected $table = "fisico_regional";

    protected $primaryKey = "id_freg";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_freg',
        'id_cone',
        'cabeza_cp',
        'cabeza_sp',
        'cuello_cp',
        'cuello_sp',
        'torax_cp',
        'torax_sp',
        'abdomen_cp',
        'abdomen_sp',
        'pelvis_cp',
        'pelvis_sp',
        'extremidades_cp',
        'extremidades_sp',
        'descripcion',
        'estado'
    ];

    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
