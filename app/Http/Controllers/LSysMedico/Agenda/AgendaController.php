<?php

namespace App\Http\Controllers\LSysMedico\Agenda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Basico\Cargo;
use App\Models\Personas\Empleado;

use App\Models\Config\Configuracion;
use App\Models\Agenda\Agenda;

class AgendaController extends Controller
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
     * Cargar los datos de configuracion por empresa 
     * 
     */
    public function get_config()
    {
    	$data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        return Configuracion:: whereRaw(" id_relacion=".$id_emp)
        					->get();
    }
    /**
     *
     * Cargar las horas ocupadas por la persona 
     * 
     */
    public function get_horas_ocupadas_persona($texto)
    {
    	$filtro = json_decode($texto);
    	$data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        return Agenda::whereRaw("id_em=".$id_emp."  AND id_emp=".$filtro->id_emp." AND fecha='".$filtro->fecha."' ")
        				->orderBy("horainicio","ASC")
        				->get();
    }
    /**
     *
     *
     * Guardar agenda
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data_user=Session::get('user_data');
        
        $data["id_em"]=$data_user[0]->persona->personaempresa[0]->id_emp;
        $data["id_u"]=$data_user[0]->id_u;
        $data["turno"]=(Agenda::whereRaw("fecha='".$data["fecha"]."'")->max("turno")+1);
        
        $aux_agenda=Agenda::create($data);
        if($aux_agenda->id_ag>0){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al guardar los datos dela agenda
        }
    }
    /**
     *
     * Carga la agenda por mes y por empleado seleccionado
     * 
     */
    public function get_agenda_mes($texto)
    {
    	$filtro = json_decode($texto);
        $sql=" agenda.fecha BETWEEN '".$filtro->fechaI."' AND '".$filtro->fechaF."'";
        $sql2="";
        if($filtro->id_emp!=""){
            $sql.=" AND agenda.id_emp='".$filtro->id_emp."' ";
            $sql2=" AND aux.id_emp=agenda.id_emp ";
        }
    	return Agenda::selectRaw("*")
                    ->selectRaw("  (SELECT COUNT(*) FROM agenda AS aux WHERE aux.fecha=agenda.fecha ".$sql2." ) AS NumeroCita  ")
                    ->whereRaw($sql)
                    ->groupBy("agenda.fecha")
                    ->orderBy("agenda.fecha","ASC")
                    ->get();
    } 
    /**
     *
     * informacion de la agenda por dia 
     * 
     */
     public function get_info_agenda_mensual($texto){
        $filtro = json_decode($texto);
        $sql=" agenda.fecha='".$filtro->Fecha."'  ";
        if($filtro->id_emp!=""){
            $sql.=" AND agenda.id_emp='".$filtro->id_emp."' ";
        }
        return Agenda::with("usuario.persona","cliente.persona","empleado.persona")
                    ->whereRaw($sql)
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();
     } 
    /**
     *
     * informacion de la agenda por semana
     * 
     */
    public function get_agenda_semana($texto){
        $filtro = json_decode($texto);
        $sql=" agenda.fecha BETWEEN '".$filtro->fechaI."' AND '".$filtro->fechaF."'";
        if($filtro->id_emp!=""){
            $sql.=" AND agenda.id_emp='".$filtro->id_emp."' ";
        }
        $Citas=Agenda::with("usuario.persona","cliente.persona","empleado.persona")
                    ->whereRaw($sql)
                    ->orderBy("agenda.fecha","ASC")
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();
        $horas=Agenda::whereRaw($sql)
                    ->groupBy("agenda.horainicio")
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();
        $data = array(
                'Horas' => $horas, 
                'Citas' => $Citas
            );
        return $data;
    }
    /**
     *
     *
     * Modificar  agenda
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $respuesta=Agenda::whereRaw("id_ag=".$id);
        if($respuesta->update($data)){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al modificar  los datos de la agenda
        }
    }  
}
