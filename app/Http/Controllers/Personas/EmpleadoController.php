<?php

namespace App\Http\Controllers\Personas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Personas\Persona;
use App\Models\Personas\Empleado;
use App\Models\Personas\PersonaEmpresa;


class EmpleadoController extends Controller
{
    /**
     *
     * Cargar los permisos de empleado
     * 
     */
    public function index()
    {
    	if(Session::has('user_data')){
    		$data_user=Session::get('user_data');
     		$permisos=json_decode($data_user[0]->permisos[0]->acceso);
     		//id_men =9 = registro de empleados
     		$aux_permiso=array();
     		foreach ($permisos as $p) {
     			if($p->id_men==9){
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
     * Lista de Empleados
     *
     */
    public function get_list_empleado(Request $request)
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $filter = json_decode($request->get('filter'));
        $estado=$filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND CONCAT(persona.apellido,' ',persona.nombre) LIKE '%".$filter->buscar."%' ";
        }
        $data=Empleado::with(["persona"=>function($query) use ($sql, $estado){
        				$query->whereRaw(" persona.estado='1' ".$sql)
        				->orderBy( "persona.apellido","ASC");
        			},"persona.personaempresa"=>function($query) use ($id_emp){
                        $query->whereRaw(" personaempresa.id_emp='".$id_emp."'");
                    }])
        			->whereRaw(" empleado.estado='".$filter->estado."' ");
        return $data->paginate(5);
    }
	/**
     *
     * Crear Empleado
     * 
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$aux_persona=Persona::create($data["Persona"]);
    	if($aux_persona->id_pe>0){
    		$data["Empleado"]["id_pe"]=$aux_persona->id_pe;
    		$aux_empleado=Empleado::create($data["Empleado"]);

    		if($aux_empleado->id_emp>0){

                $data_user=Session::get('user_data');
                $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
                $persoemp=new PersonaEmpresa;
                $persoemp->id_pe=$aux_persona->id_pe;
                $persoemp->id_emp=$id_emp;
                $persoemp->save(); //empleado guardando a la empresa que pertence


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
    			return response()->json(['success' => 2]); //error empleado
    		}

    	}else{
    		return response()->json(['success' => 1]); //error persona
    	}
    }
     /**
     *
     *
     * Actualizar datos del empleado
     *
     */
    public function update_empleado(Request $request, $id)
    {
    	$data = $request->all();
    	$aux_persona= (array) $data["Persona"];
    	$respuesta=Persona::whereRaw(" id_pe='".$id."' ")
    						->update($aux_persona);

		$aux_empleado=(array) $data["Empleado"];
		$aux_respusta_empleado=Empleado::whereRaw( " id_pe='".$id."' " )
											->update($aux_empleado);
    	
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

    	if($respuesta==1 || $aux_respusta_empleado==1){
    		return response()->json(['success' => 0]); //ok
    	}else{
    		return response()->json(['success' => 1]); //error al modificar los datos
    	}
    }
     /**
     *
     *
     * cambiar estado del empleado
     *
     */
    public function modify_estado($texto)
    {
    	$datos = json_decode($texto);
    	$aux_user=Empleado::find($datos->id_emp);
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
     * Lista de empleados
     *
     */
    public function get_list_empleado_excell($texto)
    {
        $filter = json_decode($texto);
        $estado=$filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND CONCAT(persona.apellido,' ',persona.nombre) LIKE '%".$filter->buscar."%' ";
        }
        return Empleado::with(["persona"=>function($query) use ($sql, $estado){
        				$query->whereRaw(" persona.estado='1' ".$sql)
        				->orderBy( "persona.apellido","ASC");
        			}])
        			->whereRaw(" empleado.estado='".$filter->estado."' ")
        			->get();

    }    
}
