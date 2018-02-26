<?php

namespace App\Http\Controllers\LSysMedico\Odontologia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Models\Odontologia\TratamientoOdontologico;


class Tratamiento extends Controller
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
            //id_men =13 = agendar citas general
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==13){
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
     * Lista tratamiento odontologico
     *
     */

    public function get_list_tratamiento_odontologico(Request $request)
    {
        /*$data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $filter = json_decode($request->get('filter'));
        $estado=$filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND ( codigo LIKE '%".$filter->buscar."%'  OR descripcion LIKE '%".$filter->buscar."%')";
        }*/

        return TratamientoOdontologico::whereRaw("estado='1' ")->orderBy("descripcion","ASC")->get();
    } 

	/**
     *
     *
     * Guardar trataieto odontologico
     *
     */
    public function store(Request $request)
    {
    	 $data = $request->all();
    	 
    }
}
