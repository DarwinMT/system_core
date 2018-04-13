<?php

namespace App\Models\Odontologia;

use Illuminate\Database\Eloquent\Model;

class CobroPrefactura extends Model
{
	protected $table = "cobro_prefactura";

    protected $primaryKey = "id_cob";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_cob',
        'id_tipp',
        'id_prof',
        'fecha',
        'descripcion',
        'dinero',
        'estado',
    ];
    public function proforma()
    {
        return $this->belongsTo('App\Models\Odontologia\ProformaPrefacturaConsulta',"id_prof");
    }
}
