<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Cie extends Model
{
    protected $table = "cie";

    protected $primaryKey = "id_ci";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_ci',
        'id_clasf',
        'orden',
        'imagen',
        'fechaingreso',
        'codigo',
        'descripcion',
        'estado'
    ];

}
