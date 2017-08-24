<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Usuario\Rol;
use App\Models\Usuario\Permisos;
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
    /**
     *
     *
     * Guardar Roles
     *
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$aux_rol=Rol::create($data);
    	if($aux_rol->id_r>0){
    		return response()->json(['success' => 0]); //ok
    	}else{
    		return response()->json(['success' => 1]); //error al guardar los datos del rol
    	}
    }
    /**
     *
     *
     * Modificar  Roles
     *
     */
    public function update(Request $request, $id)
    {
    	$data = $request->all();
        $respuesta=Rol::whereRaw("id_r=".$id)
                            ->update($data);
        if($respuesta==1){
            return response()->json(['success' => 0]); //ok
        }else{
           return response()->json(['success' => 1]); //error al modificar  los datos del rol
        }
    }
    /**
     *
     *
     * cambiar estado del rol del usuario
     *
     */
    public function modify_estado($texto)
    {
    	$datos = json_decode($texto);
    	$aux_valida=Permisos::whereRaw("id_r=".$datos->id_r." ")->get();
    	if(count($aux_valida)==0){
    		$aux_rol=Rol::find($datos->id_r);
	    	$aux_rol->estado=$datos->estado;
	    	if($aux_rol->save()){
	    		return response()->json(['success' => 0]); //ok
	    	}else{
	    		return response()->json(['success' => 1]); //error al modificar el estado
	    	}
    	}else{
    		return response()->json(['success' => 2]); //error al modificar el estado por uso
    	}
    }
}
