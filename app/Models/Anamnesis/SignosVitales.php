<?php

namespace App\Models\Anamnesis;

use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
	protected $table = "signos_vitales";

    protected $primaryKey = "id_sigv";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_sigv',
        'id_cone',
        'fechamedicion',
        'temperatura',
        'presionarterial',
        'pulso',
        'frerespiratoria',
        'peso',
        'talla',
        'estado'
    ];

    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
