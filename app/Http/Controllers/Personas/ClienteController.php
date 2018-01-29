<?php

namespace App\Http\Controllers\Personas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Personas\Persona;
use App\Models\Personas\Cliente;
use App\Models\Personas\PersonaEmpresa;
use App\Models\Config\Configuracion;
class ClienteController extends Controller
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
     		//id_men =8 = registro de clientes
     		$aux_permiso=array();
     		foreach ($permisos as $p) {
     			if($p->id_men==8){
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
     * Lista de clientes
     *
     */
    public function get_list_cliente(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $estado=$filter->estado;
        $sql="";
        $sqlcl="";
        if($filter->buscar!=""){
            $sql=" OR CONCAT(persona.apellido,' ',persona.nombre) LIKE '%".$filter->buscar."%' ";
            $sqlcl=" OR cliente.numerohistoria LIKE '%".$filter->buscar."%' ";
        }
        /*$data=Cliente::with(["persona"=>function($query) use ($sql, $estado){
        				$query->selectRaw("*")
        				->selectRaw("   CONCAT(YEAR(FROM_DAYS(DATEDIFF(NOW(), persona.fechan ))), ' años, ', MONTH(FROM_DAYS(DATEDIFF(NOW(), persona.fechan ))), ' meses y ', DAY(FROM_DAYS(DATEDIFF(NOW(), persona.fechan ))), ' días') AS edad")
        				->whereRaw(" persona.estado='1' ".$sql)
        				->orderBy( "persona.apellido","ASC");
        			}])
        			->whereRaw(" cliente.estado='".$filter->estado."' ".$sqlcl);
        return $data->paginate(5);*/
        
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $confi=Configuracion:: whereRaw(" id_relacion=".$id_emp."  AND identificador='RG_COMPARTIR_CLIENTE' " )->get();
        $aux_clie_all="";
        if($confi[0]->valor=="1"){
            $aux_clie_all.=" AND cliente.id_pe IN (SELECT personaempresa.id_pe  FROM personaempresa WHERE  personaempresa.id_emp='".$id_emp."') ";
        }
        $data=Cliente::with("persona")
                    ->join("persona", "persona.id_pe","=", "cliente.id_pe")
                    ->whereRaw(" (cliente.estado='".$filter->estado."'  ".$sql.")  ".$aux_clie_all)
                    ->orderBy("persona.apellido","ASC")
                    ->orderBy("persona.nombre","ASC");
                    
        return $data->paginate(5);
    }
     /**
     *
     * Crear Cliente
     * 
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$aux_persona=Persona::create($data["Persona"]);
    	if($aux_persona->id_pe>0){
    		$data["Cliente"]["id_pe"]=$aux_persona->id_pe;
    		$aux_cliente=Cliente::create($data["Cliente"]);


    		if($aux_cliente->id_cli>0){
    			$aux2_client=Cliente::find($aux_cliente->id_cli);
	    		$aux2_client->numerohistoria=str_pad($aux_cliente->id_cli, 10, "0", STR_PAD_LEFT);
	    		$aux2_client->save();

                $data_user=Session::get('user_data');
                $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
                $persoemp=new PersonaEmpresa;
                $persoemp->id_pe=$aux_persona->id_pe;
                $persoemp->id_emp=$id_emp;
                $persoemp->save(); //cliente guardando a la empresa que pertence



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
    			return response()->json(['success' => $aux_cliente->id_cli ]); //error cliente
    		}

    	}else{
    		return response()->json(['success' => 1]); //error persona
    	}
    }
     /**
     *
     *
     * Actualizar datos del cliente
     *
     */
    public function update_cliente(Request $request, $id)
    {
    	$data = $request->all();
    	$aux_persona= (array) $data["Persona"];
    	$respuesta=Persona::whereRaw(" id_pe='".$id."' ")
    						->update($aux_persona);

		$aux_cliente=(array) $data["Cliente"];
		$aux_respusta_client=Cliente::whereRaw( " id_pe='".$id."' " )
											->update($aux_cliente);
    	
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

    	if($respuesta==1 || $aux_respusta_client==1){
    		return response()->json(['success' => 0]); //ok
    	}else{
    		return response()->json(['success' => 1]); //error al modificar los datos
    	}
    }
     /**
     *
     *
     * cambiar estado del cliente
     *
     */
    public function modify_estado($texto)
    {
    	$datos = json_decode($texto);
    	$aux_user=Cliente::find($datos->id_cli);
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
     * Lista de proveedores
     *
     */
    public function get_list_client_excell($texto)
    {
        $filter = json_decode($texto);
        $estado=$filter->estado;
        $sql="";
        $sqlcl="";
        if($filter->buscar!=""){
            $sql=" OR CONCAT(persona.apellido,' ',persona.nombre) LIKE '%".$filter->buscar."%' ";
            $sqlcl=" OR cliente.numerohistoria LIKE '%".$filter->buscar."%' ";
        }
        return Cliente::with(["persona"=>function($query) use ($sql, $estado){
        				$query->selectRaw("*")
        				->selectRaw("   CONCAT(YEAR(FROM_DAYS(DATEDIFF(NOW(), persona.fechan ))), ' años, ', MONTH(FROM_DAYS(DATEDIFF(NOW(), persona.fechan ))), ' meses y ', DAY(FROM_DAYS(DATEDIFF(NOW(), persona.fechan ))), ' días') AS edad")
        				->whereRaw(" persona.estado='1' ".$sql)
        				->orderBy( "persona.apellido","ASC");
        			}])
        			->whereRaw(" cliente.estado='".$filter->estado."' ".$sqlcl)
        			->get();
        

    }
}
