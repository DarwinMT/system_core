<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



use App\Models\Basico\Item;
use App\Models\Receta\Prescripcion;
use App\Models\Receta\PrescripcionItem;


class MedicamentoController extends Controller
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
            //id_men =18 = vademecum
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==18){
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
     * lista de medicamentos
     *
     */
    public function get_medicamentos($texto)
    {   //$filtro = json_decode($texto);
        return Item::orderBy("descripcion")
        				->get();
    }
    /**
     *
     * Lista vademecum
     *
     */
    public function get_list_vademecum(Request $request)
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $filter = json_decode($request->get('filter'));
        $estado=$filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" AND ( codigo LIKE '%".$filter->buscar."%'  OR descripcion LIKE '%".$filter->buscar."%')";
        }

        $data=Item::whereRaw("id_clasit=1 AND estado='".$estado."'  ".$sql);


        return $data->paginate(5);
    }
    /**
     *
     *
     * Guardar Medicamento
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $aux=Item::create($data);
        if($aux->id_item>0){
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
        $respuesta=Item::find($id);
        $respuesta->descripcion=$data["descripcion"];
        $respuesta->presentacion=$data["presentacion"];
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
        $aux_valida=PrescripcionItem::whereRaw("id_item=".$datos->id_item." ")->get();
        if(count($aux_valida)==0){
            $aux=Item::find($datos->id_item);
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
