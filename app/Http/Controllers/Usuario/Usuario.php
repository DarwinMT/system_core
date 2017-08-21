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
    /**
     *
     *
     * Actualizar datos princiaples del usuario
     *
     */
    public function update_user(Request $request, $id)
    {
    	$data = $request->all();
    	$aux_persona= (array) $data["Persona"];
    	$respuesta=Persona::whereRaw(" id_pe='".$id."' ")
    						->update( $aux_persona);
    	
    	if ($request->hasFile('file')) {
            $image = $request->file('file');
            $destinationPath = public_path() . '/upload/persona/'.$aux_persona["id_pe"];
            if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
            $destinationPath.='/avatar';
            if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
            $name = rand(0, 9999) . '_' . $image->getClientOriginalName();
            if($image->move($destinationPath, $name)) {
                $aux_persona_avatar=Persona::find($aux_persona["id_pe"]);
                $aux_persona_avatar->avatar='/upload/persona/'.$aux_persona["id_pe"].'/avatar/'.$name;
                $aux_persona_avatar->save();
                return response()->json(['success' => 0]); //ok
            }
        }

    	if($respuesta==1){
    		return response()->json(['success' => 0]); //ok
    	}else{
    		return response()->json(['success' => 1]); //error al modificar los datos
    	}
    }
    /**
     *
     *
     * cambiar estado del usuario
     *
     */
    public function modify_estado($texto)
    {
    	$datos = json_decode($texto);
    	$aux_user=User::find($datos->id_u);
    	$aux_user->estado=$datos->estado;
    	if($aux_user->save()){
    		return response()->json(['success' => 0]); //ok
    	}else{
    		return response()->json(['success' => 1]); //error al modificar el estado
    	}
    }
    /**
     *
     *
     * validar el usuario existente
     *
     */
    public function valida_user($filtro)
    {
    	$datos = json_decode($filtro);

    	if($datos->id!=""){
    		$aux_user_existente=User::whereRaw(" id_u!='".$datos->id."'  AND username LIKE '%".$datos->username."%' ")->get();;
    		return count($aux_user_existente);
    	}else{
    		$aux_user_nuevo=User::whereRaw("  username LIKE '%".$datos->username."%' ")->get();;
    		return count($aux_user_nuevo);
    	}
    }
}
