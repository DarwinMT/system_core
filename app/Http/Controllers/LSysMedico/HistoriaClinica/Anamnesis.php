<?php

namespace App\Http\Controllers\LSysMedico\HistoriaClinica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario\User;
use App\Models\Basico\Cargo;
use App\Models\Personas\Empleado;

use App\Models\Config\Configuracion;
use App\Models\Agenda\Agenda;


use App\Models\Anamnesis\ConsultaExterna;
use App\Models\Anamnesis\AntecedentesFamiliares;
use App\Models\Anamnesis\Diagnostico;
use App\Models\Anamnesis\FisicoRegional;
use App\Models\Anamnesis\OrganosSistemas;
use App\Models\Anamnesis\SignosVitales;

use App\Models\Basico\Cie;


class Anamnesis extends Controller
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
     * Cargar historia clinica seleccionada
     *
     */
    public function get_anamnesistoid($texto)
    {
        $filtro = json_decode($texto);
        return ConsultaExterna::with("signosvitales","antecedentesfamiliares",
                                            "organossistemas","fisicoregional","diagnostico.cie")
                            ->WhereRaw("id_cone=1")
                            ->get();
    }

}
