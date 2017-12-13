<?php

namespace App\Models\Receta;

use Illuminate\Database\Eloquent\Model;

class PrescripcionItem extends Model
{
    protected $table = "prescripcion_item";

    protected $primaryKey = "id_presit";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_presit',
        'id_pres',
        'id_item',
        'cantidad',
        'indicaciones'
    ];

    public function prescripcion()
    {
        return $this->belongsTo('App\Models\Receta\Prescripcion',"id_pres");
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Basico\Item',"id_item");
    }
}
