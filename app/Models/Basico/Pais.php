<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	protected $table = "pais";

    protected $primaryKey = "id_pa";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_pa',
        'descripcion',
        'estado'
    ];
}
