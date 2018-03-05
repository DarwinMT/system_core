<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Basico\Empresa;
use App\Models\Personas\Persona;
use App\Models\Personas\PersonaEmpresa;
use App\Models\Usuario\User;
use App\Models\Usuario\Permisos;
use App\Models\Config\Configuracion;

class EmpresaController extends Controller
{
     /*
     * Cargar los permisos de empresa
     *
     */
    public function index()
    {
        if(Session::has('user_data')){
            $data_user=Session::get('user_data');
            $permisos=json_decode($data_user[0]->permisos[0]->acceso);
            //id_men =2 = empresa 
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==2){
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
     * Informacion de la empresa
     *
     */
    public function get_dataempresa()
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        /*return Empresa::with("ciudad.provincia.pais")
        				->whereRaw(" id_emp=".$id_emp."")
        				->get();*/
        $info_empresa=Empresa::with("ciudad.provincia.pais")
                        ->whereRaw(" id_emp=".$id_emp."")
                        ->get();
        $info_config=Configuracion::whereRaw("id_relacion=".$id_emp."")->get();
        $data = array(
            'Empresa' => $info_empresa,
            'Configuracion'=> $info_config );
        return $data;
    }
     /**
     *
     *
     * Actualizar datos de la empresa
     *
     */
    public function update_empresa(Request $request, $id)
    {
    	$data = $request->all();
    	$emp= Empresa::find($id);
    	$emp->id_ci=$data["Empresa"]["id_ci"];
    	$emp->nombre=$data["Empresa"]["nombre"];
    	$emp->direccion=$data["Empresa"]["direccion"];
    	$emp->telefono=$data["Empresa"]["telefono"];
    	$emp->ruc=$data["Empresa"]["ruc"];

    	if($emp->save()){

            $aux1=Configuracion::find($data["Configuracion"][0]["id_conf"]);
            $aux1->valor=$data["Configuracion"][0]["valor"];
            $aux1->save();

            $aux1=Configuracion::find($data["Configuracion"][1]["id_conf"]);
            $aux1->valor=$data["Configuracion"][1]["valor"];
            $aux1->save();

            $aux1=Configuracion::find($data["Configuracion"][2]["id_conf"]);
            $aux1->valor=$data["Configuracion"][2]["valor"];
            $aux1->save();

            $aux1=Configuracion::find($data["Configuracion"][3]["id_conf"]);
            $aux1->valor=$data["Configuracion"][3]["valor"];
            $aux1->save();



	    	if ($request->hasFile('file')) {
	            $image = $request->file('file');
	            $destinationPath = public_path() . '/upload/Empresa/'.$id;
	            if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
	            $destinationPath.='/logo';
	            if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
	            $name = rand(0, 9999) . '_' . $image->getClientOriginalName();
	            if($image->move($destinationPath, $name)) {
	                $emp= Empresa::find($id);
	                $emp->logo='/upload/Empresa/'.$id.'/logo/'.$name;
	                $emp->save();
	                return response()->json(['success' => 0]); //ok
	            }
	        }
	        return response()->json(['success' => 0]); //ok	
    	}else{
    		return response()->json(['success' => 1]); //error al modificar los datos
    	}

    }
     /**
     *
     *
     * Crear empresa a nivel administrador (este metodo temporal se debe pasar a otro controlador iou vista)
     *
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $emp=new Empresa;
        $emp->id_ci=$data["Empresa"]["id_ci"];
        $emp->nombre=$data["Empresa"]["nombre"];
        $emp->direccion=$data["Empresa"]["direccion"];
        $emp->telefono=$data["Empresa"]["telefono"];
        $emp->ruc=$data["Empresa"]["ruc"];
        $emp->estado=1;
        if($emp->save()){

            if ($request->hasFile('file_emp')) {
                $image = $request->file('file_emp');
                $destinationPath = public_path() . '/upload/Empresa/'.$emp->id_emp;
                if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
                $destinationPath.='/logo';
                if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
                $name = rand(0, 9999) . '_' . $image->getClientOriginalName();
                if($image->move($destinationPath, $name)) {
                    $emplogo= Empresa::find($emp->id_emp);
                    $emplogo->logo='/upload/Empresa/'.$emp->id_emp.'/logo/'.$name;
                    $emplogo->save();
                }
            }


            $per=new Persona;
            $per->ci=$data["Persona"]["ci"];
            $per->nombre=$data["Persona"]["nombre"];
            $per->apellido=$data["Persona"]["apellido"];
            $per->genero=$data["Persona"]["genero"];
            $per->fechan=$data["Persona"]["fechan"];
            $per->direccion=$data["Persona"]["direccion"];
            $per->email=$data["Persona"]["email"];
            $per->estado=1;
            if($per->save()){

                if ($request->hasFile('file_per')) {
                    $image = $request->file('file_per');
                    $destinationPath = public_path() . '/upload/persona/'.$per->id_pe;
                    if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
                    $destinationPath.='/avatar';
                    if(!file_exists($destinationPath)) mkdir($destinationPath, 0777);
                    $name = rand(0, 9999) . '_' . $image->getClientOriginalName();
                    if($image->move($destinationPath, $name)) {
                        $aux_persona_avatar=Persona::find($per->id_pe);
                        $aux_persona_avatar->avatar='/upload/persona/'.$per->id_pe.'/avatar/'.$name;
                        $aux_persona_avatar->save();
                    }
                }
                $peremp=new PersonaEmpresa;
                $peremp->id_pe=$per->id_pe;
                $peremp->id_emp=$emp->id_emp;
                $peremp->estado=1;
                if($peremp->save()){

                    $useradm=new User;
                    $useradm->id_pe=$per->id_pe;
                    $useradm->username=$data["Usuario"]["username"];
                    $useradm->password=Hash::make($data["Usuario"]["password"]);
                    $useradm->estado=1;
                    if($useradm->save()){

                        $aux_accesofijo='[{"id_men":2,"id_nodmen":1,"titulo":"Empresa","url":"#RegistroEmpresa","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":4,"id_nodmen":3,"titulo":"Pais","url":"#Pais","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":5,"id_nodmen":3,"titulo":"Provincia","url":"#Provincia","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":6,"id_nodmen":3,"titulo":"Ciudad","url":"#Ciudad","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":18,"id_nodmen":3,"titulo":"Vadem\u00e9cum","url":"#Vademecum","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":20,"id_nodmen":3,"titulo":"Roles","url":"#RolesUsuario","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":21,"id_nodmen":3,"titulo":"Cargo Empleado","url":"#RegistroCargo","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":8,"id_nodmen":7,"titulo":"Registro Cliente","url":"#RegistroCliente","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":9,"id_nodmen":7,"titulo":"Registro Empleado","url":"#RegistroEmpleado","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":10,"id_nodmen":7,"titulo":"Registro Proveedor","url":"#RegistroProveedor","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":11,"id_nodmen":7,"titulo":"Cita","url":"#AgendaPerson","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":12,"id_nodmen":7,"titulo":"Historial Cliente","url":"#Historia","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":13,"id_nodmen":7,"titulo":"Agenda","url":"#Agenda","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":19,"id_nodmen":7,"titulo":"Registro Usuario","url":"#RegistroUsuario","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":23,"id_nodmen":22,"titulo":"Historial Anamnesis","url":"#Historia","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":24,"id_nodmen":22,"titulo":"Historial Odontologia","url":"#HistorialOdontologia","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":25,"id_nodmen":22,"titulo":"Graficos","url":"#Graficos","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":16,"id_nodmen":100,"titulo":"Perfil","url":"#Perfil","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1},{"id_men":17,"id_nodmen":100,"titulo":"Salir","url":"\/logout_system","html":null,"estado":"1","access_ready":1,"access_save":1,"access_edit":1,"access_delete":1,"access_print":1,"access_excell":1}]';
                        $perusr=new Permisos;
                        $perusr->id_u=$useradm->id_u;
                        $perusr->id_r=1; // admin
                        $perusr->acceso=$aux_accesofijo;
                        $perusr->estado=1;
                        if($perusr->save()){

                            $conf1=new Configuracion;
                            $conf1->identificador="RG_HORA_INICIO_AGENDA";
                            $conf1->id_relacion=$emp->id_emp;
                            $conf1->valor=$data["Configuracion"]["HoraI"];
                            $conf1->save();

                            $conf2=new Configuracion;
                            $conf2->identificador="RG_HORA_FIN_AGENDA";
                            $conf2->id_relacion=$emp->id_emp;
                            $conf2->valor=$data["Configuracion"]["HoraF"];
                            $conf2->save();


                            $conf3=new Configuracion;
                            $conf3->identificador="RG_INTERVALO_AGENDA";
                            $conf3->id_relacion=$emp->id_emp;
                            $conf3->valor=$data["Configuracion"]["Intervalo"];
                            $conf3->save();


                            $conf4=new Configuracion;
                            $conf4->identificador="RG_COMPARTIR_CLIENTE";
                            $conf4->id_relacion=$emp->id_emp;
                            $conf4->valor=$data["Configuracion"]["Compartir"];
                            $conf4->save();



                            return response()->json(['success' => 0]); //Ok
                        }else{
                            return response()->json(['success' => 4]); //error de asigancion de permisos al usuario
                        }

                    }else{
                        return response()->json(['success' => 4]); //error al crear el usuario
                    }

                }else{
                    return response()->json(['success' => 3]); //error al crear la persona y asiganar empresa
                }

            }else{
                return response()->json(['success' => 2]); //error al crear la persona
            }
        }else{
            return response()->json(['success' => 1]); //error al crear la empresa
        }

    }
}
