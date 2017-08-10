<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Personas\Persona;
use App\Models\Personas\PersonaEmpresa;

class Usuario extends Controller
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
     		//id_men =19 = registro de usuarios
     		$aux_permiso=array();
     		foreach ($permisos as $p) {
     			if($p->id_men==19){
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
     * Crear usuario
     * 
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$aux_persona=Persona::create($data["Persona"]);
    	if($aux_persona->id_pe>0){
    		$data["User"]["id_pe"]=$aux_persona->id_pe;
    		$data["User"]["password"]= Hash::make($data["User"]["password"]);
    		$aux_user=User::create($data["User"]);
    		
    		$data_user=Session::get('user_data');
    		$id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
    		$persoemp=new PersonaEmpresa;
    		$persoemp->id_pe=$aux_persona->id_pe;
    		$persoemp->id_emp=$id_emp;

    		if($persoemp->save()){
    			if($aux_user->id_u>0){
	    			return response()->json(['success' => 0]); //ok
	    		}else{
	    			return response()->json(['success' => 3]); //error user
	    		}
    		}else{
    			return response()->json(['success' => 2]); //error persona empresa
    		}

    	}else{
    		return response()->json(['success' => 1]); //error persona
    	}
    }
    /**
     *
     *
     * Lista de usuarios
     *
     */
    public function get_list_usuario(Request $request)
    {
    	$data_user=Session::get('user_data');
    	$id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $filter = json_decode($request->get('filter'));
        $filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND usuario.username LIKE '%".$filter->buscar."%' ";
        }
        $data=User::with(["persona.personaempresa"=>function($query) use ($id_emp){
        					$query->whereRaw(" personaempresa.id_emp='".$id_emp."'");
        				},"permisos.rol"])
        			->whereRaw(" usuario.estado='".$filter->estado."' ".$sql)
                    ->orderBy("usuario.username","ASC");
        return $data->paginate(5);
    }
}