<?php

namespace App\Models\Anamnesis;

use Illuminate\Database\Eloquent\Model;

class AntecedentesFamiliares extends Model
{
	protected $table = "antecedentes_familiares";

    protected $primaryKey = "id_antf";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_antf',
        'id_cone',
        'cardiopatia',
        'diabetes',
        'vascular',
        'hipertencion',
        'cancer',
        'tuberculosis',
        'enfmental',
        'enfinfecciosa',
        'malformacion',
        'otro',
        'descripcion',
        'estado'
    ];

    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
