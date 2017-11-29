<?php

namespace App\Models\Anamnesis;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
	protected $table = "diagnostico";

    protected $primaryKey = "id_diag";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_diag',
        'id_cone',
        'id_ci'
    ];

    public function consultaexterna()
    {
        return $this->belongsTo('App\Models\Anamnesis\ConsultaExterna',"id_cone");
    }
}
