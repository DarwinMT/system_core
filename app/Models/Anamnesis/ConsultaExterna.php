<?php

namespace App\Models\Anamnesis;

use Illuminate\Database\Eloquent\Model;

class ConsultaExterna extends Model
{
	protected $table = "consulta_externa";

    protected $primaryKey = "id_cone";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_cone',
        'id_ag',
        'fecha',
        'motivo',
        'antecedentespersonales',
        'enfermedadactual',
        'planestratamiento',
        'data_json',
        'estado'
    ];

    public function agenda()
    {
        return $this->belongsTo('App\Models\Agenda\Agenda',"id_ag");
    }

    public function signosvitales()
    {
        return $this->hasMany('App\Models\Anamnesis\SignosVitales',"id_cone");
    }

    public function antecedentesfamiliares()
    {
        return $this->hasMany('App\Models\Anamnesis\AntecedentesFamiliares',"id_cone");
    }
    public function organossistemas()
    {
        return $this->hasMany('App\Models\Anamnesis\OrganosSistemas',"id_cone");
    }
    public function fisicoregional()
    {
        return $this->hasMany('App\Models\Anamnesis\FisicoRegional',"id_cone");
    }
    public function diagnostico()
    {
        return $this->hasMany('App\Models\Anamnesis\Diagnostico',"id_cone");
    }


}
