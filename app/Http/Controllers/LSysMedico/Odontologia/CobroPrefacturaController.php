<?php

namespace App\Http\Controllers\LSysMedico\Odontologia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Agenda\Agenda;
use App\Models\Anamnesis\ConsultaExterna;
use App\Models\Odontologia\TratamientoOdontologico;
use App\Models\Odontologia\Odontograma;
use App\Models\Odontologia\ConsultaTratamientoOdontologico;

use App\Models\Odontologia\ProformaPrefacturaConsulta;
use App\Models\Odontologia\CobroPrefactura;

class CobroPrefacturaController extends Controller
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
     * Guardar cobro prefactura 
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $aux_cobro=new CobroPrefactura;
        $aux_cobro->id_tipp=$data["id_tipp"];
        $aux_cobro->id_prof=$data["id_prof"];
        $aux_cobro->fecha=$data["fecha"];
        $aux_cobro->descripcion=$data["descripcion"];
        $aux_cobro->dinero=$data["dinero"];
        $aux_cobro->estado=$data["estado"];
        if($aux_cobro->save()){
            $aux_sumcobro=CobroPrefactura::selectRaw(" SUM(dinero) as totalcobrado ")
                                ->whereRaw("id_prof=".$data["id_prof"]."")->get();
            $aux_totalprefact=ProformaPrefacturaConsulta::find($data["id_prof"]);
            if($aux_sumcobro[0]->totalcobrado==$aux_totalprefact->total){
                $aux_totalprefact->estado="2";
            }else{
                $aux_totalprefact->estado="1";
            }

            if($aux_totalprefact->save()){
                return response()->json(['success' => 0]); //guardado los datos correctamente
            }
        }else{
            return response()->json(['success' => 1]); //error al guardar los datos del cobro
        }
    }
}
