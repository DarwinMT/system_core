<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Usuario\Rol;
use App\Models\Personas\Persona;
use App\Models\Personas\PersonaEmpresa;

class RolController extends Controller
{

    /**
     *
     * Cargar los permisos de usuario
     * 
     */
    public function index()
    {
    	if(Session::has('user_data')){
    		$data_user=Session::get('user_data');
     		$permisos=json_decode($data_user[0]->permisos[0]->acceso);
     		//id_men =20 = registro de roles
     		$aux_permiso=array();
     		foreach ($permisos as $p) {
     			if($p->id_men==20){
     				array_push($aux_permiso, $p);
     			}
     		}
     		if(count($aux_permiso)>0){
     			return $aux_permiso;
     		}else{
     			Session::forget('user_data');
    			return redirect('/');	
     		}
    	}else{
    		Session::forget('user_data');
    		return redirect('/');
    	}
    }
     /**
     *
     *
     * Lista de roles
     *
     */
    public function get_list_roles(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        $data=Rol::whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC");
        return $data->paginate(5);
    }
    /**
     *
     *
     * Lista de roles para excell
     *
     */
    public function get_list_roles_excell($filtro)
    {
        $filter = json_decode($filtro);
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        return Rol::whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC")
                    ->get();
    }

}
