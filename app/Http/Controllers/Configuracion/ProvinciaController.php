<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Basico\Provincia;
use App\Models\Basico\Ciudad;

class ProvinciaController extends Controller
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
            //id_men =5 = provincia
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==5){
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
     * lista de provincias
     *
     */
    public function get_provincias($texto)
    {
        $filtro = json_decode($texto);
        return Provincia::whereRaw(" id_pa=".$filtro->id_pa."")
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
        return Provincia::with("pais")
                        ->orderBy("descripcion")
                        ->get();
    }
    /**
     *
     *
     * Lista de provincias paginado
     *
     */
    public function get_list_provincia(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND descripcion LIKE '%".$filter->buscar."%' ";
        }
        $data=Provincia::with("pais")
                    ->whereRaw(" estado='".$filter->estado."' ".$sql)
                    ->orderBy("descripcion","ASC");
        return $data->paginate(5);
    }
    /**
     *
     *
     * Guardar Provincia
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $aux_pais=Provincia::create($data);
        if($aux_pais->id_pro>0){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al guardar los datos
        }
    }
     /**
     *
     *
     * Modificar  provincia
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $respuesta=Provincia::find($id);
        $respuesta->id_pa=$data["id_pa"];
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
     * cambiar estado del provincia
     *
     */
    public function modify_estado($texto)
    {
        $datos = json_decode($texto);
        $aux_valida=Ciudad::whereRaw("id_pro=".$datos->id_pro." ")->get();
        if(count($aux_valida)==0){
            $aux_pro=Provincia::find($datos->id_pro);
            $aux_pro->estado=$datos->estado;
            if($aux_pro->save()){
                return response()->json(['success' => 0]); //ok
            }else{
                return response()->json(['success' => 1]); //error al modificar el estado
            }
        }else{
            return response()->json(['success' => 2]); //error al modificar el estado 
        }
    }    
}
