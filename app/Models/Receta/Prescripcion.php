<?php

namespace App\Models\Receta;

use Illuminate\Database\Eloquent\Model;

class Prescripcion extends Model
{
    protected $table = "prescripcion";

    protected $primaryKey = "id_pres";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_pres',
        'id_cone',
        'fecha',
        'estado'
    ];

    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
