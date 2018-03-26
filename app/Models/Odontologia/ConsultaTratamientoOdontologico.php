<?php

namespace App\Models\Odontologia;

use Illuminate\Database\Eloquent\Model;

class ConsultaTratamientoOdontologico extends Model
{
	protected $table = "consulta_tratamiento_odontologica";

    protected $primaryKey = "id_tratod";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_tratod',
        'id_cone',
        'id_trod',
        'diente',
        'fecha',
        'estado'
    ];
    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
    public function tratamientoodontologico()
    {
        return $this->belongsTo('App\Models\Odontologia\TratamientoOdontologico',"id_trod");
    }
}
