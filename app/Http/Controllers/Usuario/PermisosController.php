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
use App\Models\Usuario\Rol;
use App\Models\Usuario\Permisos;

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
    /**
     *
     * Menu sistema
     * 
     */
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
    /**
     *
     * Roles del sistema
     * 
     */
    public function get_list_rol()
    {
    	return Rol::whereRaw(" estado=1 ")->get();
    }
    /**
     *
     * Crear y editar permisos para el sistema
     * 
     */
    public function store(Request $request){
    	$data = $request->all();
    	$verifica_permisos=Permisos::whereRaw(" id_u=".$data["id_u"]." ")->get();
    	if(count($verifica_permisos)==0){ //se crear los permisos
    		$data["acceso"]=json_encode($data["acceso"]);
    		$aux_access= Permisos::create($data);
    		if($aux_access->id_per>0){
    			return response()->json(['success' => 0]); //ok
    		}else{
    			return response()->json(['success' => 1]); //error al crear los permisos
    		}
    	}else{ // se modifica los permisos 
    		$data["acceso"]=json_encode($data["acceso"]);
    		$respuesta=Permisos::whereRaw(" id_u=".$data["id_u"]." ")
    							->update($data);
    		if($respuesta==1){
    			return response()->json(['success' => 0]); //ok
    		}else{
    			return response()->json(['success' => 2]); //error al modificar los permisos
    		}
    	}
    }
}
