<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Basico\Empresa;

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
        return Empresa::with("ciudad.provincia.pais")
        				->whereRaw(" id_emp=".$id_emp."")
        				->get();
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
}
