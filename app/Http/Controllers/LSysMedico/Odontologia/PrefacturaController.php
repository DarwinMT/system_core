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

class PrefacturaController extends Controller
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
     * Guardar odontograma del paciente
     *
     */
	public function store(Request $request)
	{
        $data = $request->all();
        $aux_findprefact=ProformaPrefacturaConsulta::whereRaw("id_cone=".$data["id_cone"])->get();
        if(count($aux_findprefact)==0){
            $aux_prefactura=new ProformaPrefacturaConsulta;
            $aux_prefactura->id_cone=$data["id_cone"];
            $aux_prefactura->fecha=$data["fecha"];
            $aux_prefactura->descripcion=$data["descripcion"];
            $aux_prefactura->proforma=$data["proforma"];
            $aux_prefactura->subtotal=$data["subtotal"];
            $aux_prefactura->descuento=$data["descuento"];
            $aux_prefactura->iva=$data["iva"];
            $aux_prefactura->total=$data["total"];
            $aux_prefactura->estado="0";
            if($aux_prefactura->save()){
                if(isset($data["pago"]["id_tipopago"])){
                    $aux_cobro=new CobroPrefactura;
                    $aux_cobro->id_tipp=$data["pago"]["id_tipopago"];
                    $aux_cobro->id_prof=$aux_prefactura->id_prof;
                    $aux_cobro->fecha=$data["fecha"];
                    $aux_cobro->dinero=$data["pago"]["pago"];
                    $aux_cobro->estado="1";
                    if($aux_cobro->save()){
                        if($aux_prefactura->total == $aux_cobro->dinero){
                            $aux_prefactura->estado="2";
                        }else{
                            $aux_prefactura->estado="1";
                        }
                         if($aux_prefactura->save()){
                             return response()->json(['success' => 0]); //error al guardar los datos de la prefactura
                         }
                    }

                }
                return response()->json(['success' => 0]); //error al guardar los datos de la prefactura
            }else{
                return response()->json(['success' => 1]); //error al guardar los datos de la prefactura
            }
        }else{
            $ant_proforma= ProformaPrefacturaConsulta::find($aux_findprefact[0]->id_prof);
            $ant_proforma->fecha=$data["fecha"];
            $ant_proforma->descripcion=$data["descripcion"];
            $ant_proforma->proforma=$data["proforma"];
            $ant_proforma->subtotal=$data["subtotal"];
            $ant_proforma->descuento=$data["descuento"];
            $ant_proforma->iva=$data["iva"];
            $ant_proforma->total=$data["total"];
            if($ant_proforma->save()){
                if(isset($data["pago"]["id_tipopago"])){

                    $aux=CobroPrefactura::whereRaw("id_prof=".$ant_proforma->id_prof)->get();
                    $aux_cobro= CobroPrefactura::find($aux[0]->id_cob);

                    $aux_cobro->id_tipp=$data["pago"]["id_tipopago"];
                    $aux_cobro->id_prof=$ant_proforma->id_prof;
                    $aux_cobro->fecha=$data["fecha"];
                    $aux_cobro->dinero=$data["pago"]["pago"];
                    $aux_cobro->estado="1";
                    if($aux_cobro->save()){
                        if($ant_proforma->total == $aux_cobro->dinero){
                            $ant_proforma->estado="2";
                        }else{
                            $ant_proforma->estado="1";
                        }
                         if($ant_proforma->save()){
                             return response()->json(['success' => 0]); //error al guardar los datos de la prefactura
                         }
                    }

                }
                return response()->json(['success' => 0]); //error al guardar los datos de la prefactura
            }else{
                return response()->json(['success' => 1]); //error al guardar los datos de la prefactura
            }
        }
    }
    /**
     *
     *
     * registro prefactura y pagos 
     *
     */
    public function registro_pagosxid($texto)
    {
        $datos = json_decode($texto);
        return ProformaPrefacturaConsulta::selectRaw("proforma_prefactura_consulta.* ")
                                        ->join("consulta_externa", "consulta_externa.id_cone","=", "proforma_prefactura_consulta.id_cone")
                                        ->join("agenda", "agenda.id_ag","=", "consulta_externa.id_ag")
                                        ->whereRaw("agenda.id_cli='".$datos->id_cli."' AND agenda.id_em=".$datos->id_em." ")
                                        ->orderBy("proforma_prefactura_consulta.fecha","DESC")
                                        ->get();
    }
}
