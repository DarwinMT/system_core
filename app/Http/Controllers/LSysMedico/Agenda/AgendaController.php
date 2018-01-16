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
            $this->send_email($aux_agenda->id_ag);
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al guardar los datos dela agenda
        }
    }
    /**
     *
     * Enviar correo al cliente 
     *
     */
    public function send_email($id_ag)
    {
       $datos=Agenda::with("usuario.persona.personaempresa.empresa","cliente.persona","empleado.persona")
                    ->whereRaw("agenda.id_ag=".$id_ag."")
                    ->get();

        $para  = $datos[0]->cliente->persona->email;
        if($para!=""){
            $mensaje = "Athan le recuerda que tiene una cita medica el ".$datos[0]->fecha." a las ".$datos[0]->horainicio.". \n";
            $mensaje.=" En ".$datos[0]->usuario->persona->personaempresa[0]->empresa->nombre.", con la dirección ".$datos[0]->usuario->persona->personaempresa[0]->empresa->direccion.". \n";
            $mensaje.=" Con el medico ".$datos[0]->empleado->persona->apellido." ".$datos[0]->empleado->persona->nombre." ";

            mail($para, 'Recordatorio de cita medica', $mensaje);
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
        $sql=" agenda.fecha BETWEEN '".$filtro->fechaI."' AND '".$filtro->fechaF."' AND agenda.estado='".$filtro->estado."' ";
        $sql2="";
        if($filtro->id_emp!=""){
            $sql.=" AND agenda.id_emp='".$filtro->id_emp."' ";
            $sql2=" AND aux.id_emp=agenda.id_emp ";
        }
    	return Agenda::selectRaw("*")
                    ->selectRaw("  (SELECT COUNT(*) FROM agenda AS aux WHERE aux.fecha=agenda.fecha ".$sql2." AND aux.estado='".$filtro->estado."' ) AS NumeroCita  ")
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
        $sql=" agenda.fecha='".$filtro->Fecha."' AND agenda.estado='".$filtro->estado."' ";
        if($filtro->id_emp!=""){
            $sql.=" AND agenda.id_emp='".$filtro->id_emp."' ";
        }
        return Agenda::with("usuario.persona.personaempresa.empresa","cliente.persona","empleado.persona","consultageneral.prescripcion") //agregado la consulta externa
                    ->whereRaw($sql)
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();
     }
    /**
     *
     * informacion de la agenda por fechas y empleado
     * 
     */
     public function get_info_agenda_fechas_empleado($texto){
        $filtro = json_decode($texto);
        $sql=" agenda.fecha BETWEEN '".$filtro->Fechai."' AND '".$filtro->Fechaf."' AND agenda.estado='".$filtro->estado."' ";
        if($filtro->id_emp!=""){
            $sql.=" AND agenda.id_emp='".$filtro->id_emp."' ";
        }
        return Agenda::with("usuario.persona.personaempresa.empresa","cliente.persona","empleado.persona","consultageneral.prescripcion") //agregado la consulta externa
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
        $sql=" agenda.fecha BETWEEN '".$filtro->fechaI."' AND '".$filtro->fechaF."' AND agenda.estado='".$filtro->estado."' ";
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
            $this->send_email($id);
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al modificar  los datos de la agenda
        }
    }
    /**
 *
 *
 * cambiar estado de la agenda o cita
 *
 */
    public function modify_estado($texto)
    {
        $datos = json_decode($texto);
        $aux_agenda=Agenda::find($datos->id_ag);
        $aux_agenda->estado=$datos->estado;
        if($aux_agenda->save()){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al modificar el estado
        }
    }
    /**
     *
     * Datos usuario para la agenda
     *
     */
    public function data_user_agenda()
    {
        if(Session::has('user_data')){
            $data_user=Session::get('user_data');
            $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
            $id_per=$data_user[0]->id_pe;
            return Empleado::with("persona","cargo")
                        ->whereRaw("id_pe=".$id_per)->get();
        }else{
            Session::forget('user_data');
            return redirect('/');
        }
    }

     /**
     *
     * Numero de citas por mes
     *
     */
    public function data_numbercitas()
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        $tomonth="20".date("y-m");
        return Agenda::selectRaw("agenda.fecha")
                    ->selectRaw("(SELECT  COUNT(*) FROM agenda aux WHERE aux.fecha=agenda.fecha) AS numero")
                    ->whereRaw(" agenda.fecha LIKE '%".$tomonth."%' AND agenda.id_em=".$id_emp."")
                    ->groupBy("agenda.fecha")
                    ->get();
    }
}
