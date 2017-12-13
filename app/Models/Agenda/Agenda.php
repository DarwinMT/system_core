<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	protected $table = "agenda";

    protected $primaryKey = "id_ag";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_ag',
        'id_em',
        'id_u',
        'id_cli',
        'id_emp',
        'turno',
        'fechacreacion',
        'fecha',
        'horainicio',
        'horafin',
        'observacion',
        'tipo',
        'gestion',
        'estado'
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Basico\Empresa',"id_em");
    }
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario\User',"id_u");
    }
    public function cliente()
    {
        return $this->belongsTo('App\Models\Personas\Cliente',"id_cli");
    }
    public function empleado()
    {
        return $this->belongsTo('App\Models\Personas\Empleado',"id_emp");
    }
    public function consultageneral()
    {
        return $this->hasMany('App\Models\Anamnesis\ConsultaExterna',"id_ag");
    }
}
