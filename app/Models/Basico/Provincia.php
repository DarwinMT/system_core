<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
	protected $table = "provincia";

    protected $primaryKey = "id_pro";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_pro',
        'id_pa',
        'descripcion',
        'estado'
    ];
    public function pais()
    {
        return $this->belongsTo('App\Modelos\Basico\Pais',"id_pa");
    }
}
