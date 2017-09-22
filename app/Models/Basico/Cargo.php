<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
	protected $table = "cargo";

    protected $primaryKey = "id_carg";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_carg',
        'descripcion',
        'estado'
    ];
}
