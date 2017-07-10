<?php

namespace App\Models\Basico;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
	protected $table = "ciudad";

    protected $primaryKey = "id_ci";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_ci',
        'id_pro',
        'descripcion',
        'estado'
    ];
    public function provincia()
    {
        return $this->belongsTo('App\Modelos\Basico\Provincia',"id_pro");
    }
}
