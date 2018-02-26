<?php

namespace App\Models\Odontologia;

use Illuminate\Database\Eloquent\Model;

class TratamientoOdontologico extends Model
{
	protected $table = "tratamiento_odontologico";

    protected $primaryKey = "id_trod";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_trod',
        'id_emp',
        'codigoodont',
        'descripcion',
        'simbolo',
        'preciou',
        'descuento',
        'estado'
    ];
}
