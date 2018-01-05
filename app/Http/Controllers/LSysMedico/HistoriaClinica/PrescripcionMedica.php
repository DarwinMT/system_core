<?php

namespace App\Http\Controllers\LSysMedico\HistoriaClinica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Models\Basico\Item;
use App\Models\Receta\Prescripcion;
use App\Models\Receta\PrescripcionItem;

class PrescripcionMedica extends Controller
{
    //

    /**
     *
     * Cargar los permisos del vademecum
     *
     */
    public function index()
    {
        if(Session::has('user_data')){
            $data_user=Session::get('user_data');
            $permisos=json_decode($data_user[0]->permisos[0]->acceso);
            //id_men =18 = registro de empleados //pendiente para cargara datos cie
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
     * Lista cie10 para vademecum
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

        $data=Item::whereRaw("id_clasit=1 AND estado=1  ".$sql);


        return $data->paginate(5);
    }
    /**
     *
     *
     * Guardar prescripcion
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $preshead=new Prescripcion;
        $preshead->id_cone=$data["Citaconsulta"]["consultageneral"][0]["id_cone"];
        $preshead->fecha=$data["Fecha"];
        $preshead->estado=1;
        if($preshead->save()){
            foreach ($data["Receta"] as $m) {
                $presbody=new PrescripcionItem;
                $presbody->id_pres=$preshead->id_pres;
                $presbody->id_item=$m["item"]["id_item"];
                $presbody->cantidad=$m["cantidad"];
                $presbody->indicaciones=$m["indicaciones"];
                $presbody->save();
            }
            return response()->json(['success' => 0]); //datos guardados correctamente
        }else{
            return response()->json(['success' => 1]); //error al guardar la receta
        }
    }
    /**
     *
     * Cargar recetas
     *
     */
    public function get_recetaid($texto)
    {
        $filtro = json_decode($texto);
        $preshead=Prescripcion::whereRaw(" id_cone=".$filtro->id_cone."")
                            ->orderBy("id_pres", "DESC")
                            ->limit(1)
                            ->get();
        
        if(count($preshead)==0) return response()->json([]);

        return PrescripcionItem::with("item","prescripcion")
                                ->whereRaw(" id_pres=".$preshead[0]->id_pres."")
                                ->get();

    }
    /**
     *
     *
     * Modificar  receta
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $presant=PrescripcionItem::whereRaw("id_pres=".$id."")
                                ->delete();
        foreach ($data["Receta"] as $m) {
            $presbody=new PrescripcionItem;
            $presbody->id_pres=$id;
            $presbody->id_item=$m["item"]["id_item"];
            $presbody->cantidad=$m["cantidad"];
            $presbody->indicaciones=$m["indicaciones"];
            $presbody->save();
        }
        return response()->json(['success' => 0]); //datos guardados correctamente

    }

     /**
     *
     * estadistica de vademecum
     *
     */
    public function data_vademecum()
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        $tomonth="20".date("y-m");

        
        $sql=" IN (SELECT prescripcion.id_pres FROM prescripcion WHERE prescripcion.id_cone IN (SELECT consulta_externa.id_cone FROM consulta_externa  WHERE consulta_externa.id_ag  IN ( ";
        $sql.=" SELECT agenda.id_ag FROM agenda WHERE agenda.fecha LIKE '%".$tomonth."%' AND agenda.id_em=".$id_emp.")) )";

        return PrescripcionItem::selectRaw(" (SELECT item.descripcion FROM item WHERE item.id_item=prescripcion_item.id_item) AS Medicamento ")
                            ->selectRaw(" (SELECT  COUNT(*) FROM prescripcion_item aux WHERE aux.id_item=prescripcion_item.id_item AND aux.id_pres ".$sql." )  AS Cantidad ")
                            ->whereRaw(" prescripcion_item.id_pres ".$sql." ")
                            ->groupBy("prescripcion_item.id_item")
                            ->get();
    }
    /**
     * Imprimir anamanesis
     * 
     * 
     */
    public function print_receta($parametro)
    {   
        ini_set('max_execution_time', 300);

        $filtro = json_decode($parametro);
        $preshead=Prescripcion::whereRaw(" id_cone=".$filtro->id_cone."")
                            ->orderBy("id_pres", "DESC")
                            ->limit(1)
                            ->get();

        $receta= PrescripcionItem::with("item","prescripcion.consultaexterna.diagnostico.cie", "prescripcion.consultaexterna.agenda.cliente.persona", "prescripcion.consultaexterna.agenda.empresa.ciudad")
                                ->whereRaw(" id_pres=".$preshead[0]->id_pres."")
                                ->get();


        $today=date("Y-m-d H:i:s");
        $view =  \View::make('Print.Receta', compact('filtro','receta','today'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream("anamnesis_".$today.".pdf");
    }
}
