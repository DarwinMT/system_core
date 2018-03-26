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

class OdontogramaController extends Controller
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
		$buscar_odontograma=Odontograma::whereRaw("id_cone=".$data["id_cone"])->get();
		if(count($buscar_odontograma)==0){
            $aux=Odontograma::create($data);
			if($aux->id_odonj>0){

                $tratamiento=json_decode($data["tratamientoaplicados"]);
                foreach ($tratamiento as $t) {
                    $consulta = new ConsultaTratamientoOdontologico;
                    $consulta->id_cone=$data["id_cone"];
                    $consulta->id_trod=$t->Tratamiento;
                    $consulta->diente=$t->Diente;
                    $consulta->fecha=$data["fecha"];
                    $consulta->estado=1;
                    $aux=$consulta->save();
                }
	            return response()->json(['success' => 0]); //ok
	        }else{
	            return response()->json(['success' => 1]); //error al guardar los datos del odontograma
	        }
	    }else{
	    	$ant_odont= Odontograma::find($buscar_odontograma[0]->id_odonj);
	    	$ant_odont->odontogramajson=$data["odontogramajson"];
	    	if($ant_odont->save()){

                $tratamiento=json_decode($data["tratamientoaplicados"]);
                foreach ($tratamiento as $t) {
                    $consulta = new ConsultaTratamientoOdontologico;
                    $consulta->id_cone=$data["id_cone"];
                    $consulta->id_trod=$t->Tratamiento;
                    $consulta->diente=$t->Diente;
                    $consulta->fecha=$data["fecha"];
                    $consulta->estado=1;
                    $aux=$consulta->save();
                }
                
 				return response()->json(['success' => 0]); //ok
	    	}else{
				return response()->json(['success' => 1]); //error al guardar los datos del odontograma
	    	}
	    }
	}
	    /**
     *
     *
     * Odontograma=> ultimo odontograma 
     *
     */
    public function get_odontograma($texto)
    {
    	$datos = json_decode($texto);
    	$data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;

        return Odontograma::join("consulta_externa","odontogramajson.id_cone","=","consulta_externa.id_cone")
        					->join("agenda","consulta_externa.id_ag","=","agenda.id_ag")
        					->whereRaw("agenda.id_em=".$id_emp." AND agenda.id_cli=".$datos->id_cli."")
        					->orderBy("odontogramajson.fecha", "DESC")
        					->limit(1)
        					->get();
    }

    public function get_anamnesistoid($texto)
    {
        $filtro = json_decode($texto);
        return ConsultaExterna::with("signosvitales","antecedentesfamiliares",
                                            "organossistemas","fisicoregional","diagnostico.cie","odontograma")
                            ->WhereRaw("id_ag=".$filtro->id_ag."" )
                            ->get();

    }

     /**
     * Imprimir anamanesis con odontograma 
     * 
     * 
     */
    public function print_anamnesisodontograma($parametro)
    {   
        ini_set('max_execution_time', 300);
        $filtro = json_decode($parametro);
        $anamnesis=$this->get_anamnesistoid($parametro);
        
        $agenda=Agenda::with("usuario.persona.personaempresa.empresa","cliente.persona","empleado.persona","consultageneral.odontograma") //agregado la consulta externa
                    ->whereRaw("id_ag=".$filtro->id_ag."")
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();

        $today=date("Y-m-d H:i:s");
        $view =  \View::make('Print.AnamnesisOdontologia', compact('filtro','anamnesis','today','agenda'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream("anamnesis_".$today.".pdf");
    }

}
