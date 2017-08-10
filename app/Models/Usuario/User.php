<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "usuario";

    protected $primaryKey = "id_u";

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_u',
        'id_pe',
        'username',
        'password',
        'estado'
    ];
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas\Persona',"id_pe");
    }
    public function permisos()
    {
        return $this->hasMany('App\Models\Usuario\Permisos',"id_u");
    }
}
