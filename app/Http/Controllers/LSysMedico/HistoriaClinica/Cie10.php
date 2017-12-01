<?php

namespace App\Http\Controllers\LSysMedico\HistoriaClinica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Models\Basico\Cie;

class Cie10 extends Controller
{
    //

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
     * Lista cie10
     *
     */

    public function get_list_cie(Request $request)
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $filter = json_decode($request->get('filter'));
        $estado=$filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND ( codigo LIKE '%".$filter->buscar."%'  OR descripcion LIKE '%".$filter->buscar."%')";
        }

        $data=Cie::whereRaw("estado='1' ".$sql);


        return $data->paginate(5);
    }

}
