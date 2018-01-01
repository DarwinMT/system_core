<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Basico\Ciudad;
use App\Models\Basico\Empresa;


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
            //id_men =6 = ciudad
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==6){
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
        /**
     *
     * lista de provincias todas
     *
     */
    public function get_ciudades_all($texto)
    {
        $filtro = json_decode($texto);
        return Ciudad::with("provincia","provincia.pais")
                        ->orderBy("descripcion")
                        ->get();
    }
    /**
     *
     *
     * Lista de ciudades paginado
     *
     */
    public function get_list_ciudades(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        $data=Ciudad::with("provincia","provincia.pais")
                    ->whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC");
        return $data->paginate(5);
    }
    /**
     *
     *
     * Guardar Ciudad
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $aux_pais=Ciudad::create($data);
        if($aux_pais->id_ci>0){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al guardar los datos
        }
    }
     /**
     *
     *
     * Modificar  ciudad
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $respuesta=Ciudad::find($id);
        $respuesta->id_pro=$data["id_pro"];
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
     * cambiar estado de la ciudad
     *
     */
    public function modify_estado($texto)
    {
        $datos = json_decode($texto);
        $aux_valida=Empresa::whereRaw("id_ci=".$datos->id_ci." ")->get();
        if(count($aux_valida)==0){
            $aux=Ciudad::find($datos->id_ci);
            $aux->estado=$datos->estado;
            if($aux->save()){
                return response()->json(['success' => 0]); //ok
            }else{
                return response()->json(['success' => 1]); //error al modificar el estado
            }
        }else{
            return response()->json(['success' => 2]); //error al modificar el estado 
        }
    }    
}
