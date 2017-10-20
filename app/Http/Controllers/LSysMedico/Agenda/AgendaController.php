<?php

namespace App\Http\Controllers\LSysMedico\Agenda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Basico\Cargo;
use App\Models\Personas\Empleado;

use App\Models\Config\Configuracion;
use App\Models\Agenda\Agenda;

class AgendaController extends Controller
{
    /**
     *
     * Cargar los permisos de usuario
     * 
     */
    public function index()
    {
    	
    }

     /**
     *
     * Cargar los datos de configuracion por empresa 
     * 
     */
    public function get_config()
    {
    	$data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        return Configuracion:: whereRaw(" id_relacion=".$id_emp)
        					->get();
    }
    /**
     *
     * Cargar las horas ocupadas por la persona 
     * 
     */
    public function get_horas_ocupadas_persona($texto)
    {
    	$filtro = json_decode($texto);
    	$data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        return Agenda::whereRaw("id_em=".$id_emp."  AND id_emp=".$filtro->id_emp." AND fecha='".$filtro->fecha."' ")
        				->orderBy("horainicio","ASC")
        				->get();
    }
}
