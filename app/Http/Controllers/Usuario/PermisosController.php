<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Personas\Persona;
use App\Models\Personas\PersonaEmpresa;
use App\Models\Usuario\Modulo;

class PermisosController extends Controller
{
    /**
     *
     * valida session
     * 
     */
    public function index()
    {
    	if(!Session::has('user_data')){
    		Session::forget('user_data');
    		return redirect('/');
    	}
    }

    public function get_list_menu()
    {
    	$aux_menu=array();
    	$nodop=Modulo::whereRaw(" ISNULL(id_nodmen) ")->get();
    	foreach ($nodop as $n) {
    		$nodos=Modulo::whereRaw(" id_nodmen=".$n->id_men."")->get();
    		$aux_nodo=array(
    			'Nodo' => $n,
    			'Nodos' => $nodos
    		);
    		array_push($aux_menu, $aux_nodo);
    	}
    	return $aux_menu;
    }
}
