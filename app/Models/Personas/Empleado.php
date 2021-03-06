<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
	protected $table = "empleado";

    protected $primaryKey = "id_emp";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_emp',
        'id_pe',
        'id_carg',
        'fechaingreso',
        'estado'
    ];
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas\Persona',"id_pe");
    }

    public function cargo()
    {
        return $this->belongsTo('App\Models\Basico\Cargo',"id_carg");
    }

}
