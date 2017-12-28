<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Basico\Ciudad;


class CiudadController extends Controller
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
     * Informacion de la ciudad
     *
     */
    public function get_ciudades($texto)
    {
        $filtro = json_decode($texto);
        return Ciudad::whereRaw(" id_pro=".$filtro->id_pro."")
        				->orderBy("descripcion")
        				->get();
    }    
}
