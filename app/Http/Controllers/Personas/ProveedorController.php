<?php

namespace App\Http\Controllers\Personas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Personas\Persona;
use App\Models\Personas\Proveedor;
use App\Models\Personas\PersonaEmpresa;


class ProveedorController extends Controller
{
    /**
     *
     * Cargar los permisos de proveedor
     * 
     */
    public function index()
    {
    	if(Session::has('user_data')){
    		$data_user=Session::get('user_data');
     		$permisos=json_decode($data_user[0]->permisos[0]->acceso);
     		//id_men =10 = registro de proveedores
     		$aux_permiso=array();
     		foreach ($permisos as $p) {
     			if($p->id_men==10){
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
     * Crear Proveedor
     * 
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$aux_persona=Persona::create($data["Persona"]);
    	if($aux_persona->id_pe>0){
    		$data["Proveedor"]["id_pe"]=$aux_persona->id_pe;
    		$aux_proveedor=Proveedor::create($data["Proveedor"]);

    		if($aux_proveedor->id_prov>0){
    			if ($request->hasFile('file')) {
	                $image = $request->file('file');
	                $destinationPath = public_path() . '/upload/persona/'.$aux_persona->id_pe;
	                if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
	                $destinationPath.='/avatar';
	                if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
	                $name = rand(0, 9999) . '_' . $image->getClientOriginalName();
	                if($image->move($destinationPath, $name)) {
	                    $aux_persona_avatar=Persona::find($aux_persona->id_pe);
	                    $aux_persona_avatar->avatar='/upload/persona/'.$aux_persona->id_pe.'/avatar/'.$name;
	                    $aux_persona_avatar->save();
	                }
	            }

	    		return response()->json(['success' => 0]); //ok
	    		
    		}else{
    			return response()->json(['success' => 2]); //error proveedor
    		}

    	}else{
    		return response()->json(['success' => 1]); //error persona
    	}
    }
     /**
     *
     *
     * Lista de proveedores
     *
     */
    public function get_list_proveedor(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $estado=$filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND CONCAT(persona.apellido,' ',persona.nombre) LIKE '%".$filter->buscar."%' ";
        }
        $data=Proveedor::with(["persona"=>function($query) use ($sql, $estado){
        				$query->whereRaw(" persona.estado='".$estado."' ".$sql)
        				->orderBy( "persona.apellido","ASC");
        			}])
        			->whereRaw(" proveedor.estado='".$filter->estado."' ");
        return $data->paginate(5);
    }
}
