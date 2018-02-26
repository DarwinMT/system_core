<?php

namespace App\Models\Odontologia;

use Illuminate\Database\Eloquent\Model;

class Odontograma extends Model
{
	protected $table = "odontogramajson";

    protected $primaryKey = "id_odonj";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_odonj',
        'id_cone',
        'fecha',
        'odontogramajson',
        'estado'
    ];
    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
