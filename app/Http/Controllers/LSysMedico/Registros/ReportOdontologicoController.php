<?php

namespace App\Http\Controllers\LSysMedico\Registros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Agenda\Agenda;

class ReportOdontologicoController extends Controller
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
            //id_men =24 = agendar citas general
            $aux_permiso=array();
            foreach ($permisos as $p) {
                if($p->id_men==24){
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
     * Lista de clientes con citas medicas iou histira clinica
     *
     */
    public function get_pacientehistorias(Request $request)
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $filter = json_decode($request->get('filter'));
        $sql="";
        if($filter->buscar!=""){

            $sql=" AND agenda.id_cli IN(SELECT cl.id_cli FROM cliente cl  ";
            $sql.=" WHERE cl.id_pe IN(SELECT per.id_pe  FROM persona per WHERE per.ci LIKE '%".$filter->buscar."%'  OR  CONCAT(apellido,' ',nombre) LIKE '%".$filter->buscar."%' ) ";
            $sql.=" OR cl.numerohistoria LIKE '%".$filter->buscar."%') ";
        }
        //->whereRaw("  agenda.fecha BETWEEN '".$filter->fechai."' AND '".$filter->fechaf."' AND agenda.estado='1'  ".$sql)
        $data=Agenda::with("cliente.persona")
        			->whereRaw(" agenda.estado='1' AND agenda.id_em='".$id_emp."' ".$sql)
                    ->orderBy("agenda.fecha","ASC")
                    ->groupBy("agenda.id_cli");
        return $data->paginate(5);
    } 
     /**
     *
     * 
     * Lista de anamnesis de cliente 
     *
     */
    public function get_list_anamnesisodontograma_id(Request $request)
    {

        $filter = json_decode($request->get('filter'));

        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        $sql =" agenda.estado='1' AND agenda.id_em='".$id_emp."' AND  agenda.id_cli='".$filter->id_cli."'";
        $data=Agenda::with("cliente.persona","empleado.persona","empresa","consultageneral.prescripcion","consultageneral.odontograma")
        			->join("consulta_externa","consulta_externa.id_ag","=","agenda.id_ag")
        			->join("odontogramajson","odontogramajson.id_cone","=","consulta_externa.id_cone")
        			->whereRaw($sql)
                    ->orderBy("agenda.fecha","DESC");
        return $data->paginate(5);
    }   

}
