<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Basico\Pais;
use App\Models\Basico\Provincia;


class PaisController extends Controller
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
            //id_men =4 = pais
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==4){
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
     * lista de paises
     *
     */
    public function get_paises($texto)
    {
        //$filtro = json_decode($texto);
        return Pais::whereRaw(" estado=1")
        				->orderBy("descripcion")
        				->get();
    }
    /**
     *
     *
     * Lista de paises paginado
     *
     */
    public function get_list_pais(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        $data=Pais::whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC");
        return $data->paginate(5);
    }
    /**
     *
     *
     * Guardar Pais
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $aux_pais=Pais::create($data);
        if($aux_pais->id_pa>0){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al guardar los datos
        }
    } 
     /**
     *
     *
     * Modificar  Pais
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $respuesta=Pais::find($id);
        $respuesta->descripcion=$data["descripcion"];
        if($respuesta->save()){
            return response()->json(['success' => 0]); //ok
        }else{
           return response()->json(['success' => 1]); //error al modificar  los datos 
        }
    }    
    /**
     *
     *
     * cambiar estado del pais
     *
     */
    public function modify_estado($texto)
    {
        $datos = json_decode($texto);
        $aux_valida=Provincia::whereRaw("id_pa=".$datos->id_pa." ")->get();
        if(count($aux_valida)==0){
            $aux_pais=Pais::find($datos->id_pa);
            $aux_pais->estado=$datos->estado;
            if($aux_pais->save()){
                return response()->json(['success' => 0]); //ok
            }else{
                return response()->json(['success' => 1]); //error al modificar el estado
            }
        }else{
            return response()->json(['success' => 2]); //error al modificar el estado 
        }
    }     
}
