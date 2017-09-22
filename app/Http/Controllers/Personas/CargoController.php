<?php

namespace App\Http\Controllers\Personas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Basico\Cargo;
use App\Models\Personas\Empleado;


class CargoController extends Controller
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
     * Lista de cargos
     *
     */
    public function get_list_cargos(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        $data=Cargo::whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC");
        return $data->paginate(5);
    }
    /**
     *
     *
     * Lista de cargos para excell
     *
     */
    public function get_list_cargos_excell($filtro)
    {
        $filter = json_decode($filtro);
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        return Cargo::whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC")
                    ->get();
    }    
    /**
     *
     *
     * Guardar Cargos
     *
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$aux_cargo=Cargo::create($data);
    	if($aux_cargo->id_carg>0){
    		return response()->json(['success' => 0]); //ok
    	}else{
    		return response()->json(['success' => 1]); //error al guardar los datos del cargo
    	}
    } 
     /**
     *
     *
     * Modificar  Cargos
     *
     */
    public function update(Request $request, $id)
    {
    	$data = $request->all();
        $respuesta=Cargo::whereRaw("id_carg=".$id)
                            ->update($data);
        if($respuesta==1){
            return response()->json(['success' => 0]); //ok
        }else{
           return response()->json(['success' => 1]); //error al modificar  los datos del cargo
        }
    }
    /**
     *
     *
     * cambiar estado del cargo del empleado
     *
     */
    public function modify_estado($texto)
    {
    	$datos = json_decode($texto);
    	$aux_valida=Empleado::whereRaw("id_carg=".$datos->id_carg." ")->get();
    	if(count($aux_valida)==0){
    		$aux_cargo=Cargo::find($datos->id_carg);
	    	$aux_cargo->estado=$datos->estado;
	    	if($aux_cargo->save()){
	    		return response()->json(['success' => 0]); //ok
	    	}else{
	    		return response()->json(['success' => 1]); //error al modificar el estado
	    	}
    	}else{
    		return response()->json(['success' => 2]); //error al modificar el estado por cargo de empleado
    	}
    }    
}
