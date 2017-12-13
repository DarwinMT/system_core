<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";

    protected $primaryKey = "id_item";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_item',
        'id_clasit',
        'id_prov',
        'orden',
        'imagen',
        'fechaingreso',
        'codigo',
        'descripcion',
        'presentacion',
        'precio',
        'estado'
    ];

}
