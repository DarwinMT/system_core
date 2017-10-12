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
}
