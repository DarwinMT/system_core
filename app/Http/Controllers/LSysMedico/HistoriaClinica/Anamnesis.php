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
                            ->WhereRaw("id_ag=".$filtro->id_ag."" )
                            ->get();

    }

    /**
     *
     *
     * Guardar anamnesis
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $consulta=new ConsultaExterna;
        $consulta->id_ag=$data[0]["id_ag"];
        $consulta->fecha=$data[0]["fecha"];
        $consulta->motivo=$data[0]["motivo"];
        $consulta->antecedentespersonales=$data[0]["antecedentespersonales"];
        $consulta->enfermedadactual=$data[0]["enfermedadactual"];
        $consulta->planestratamiento=$data[0]["planestratamiento"];
        $consulta->data_json=json_encode($data);
        $consulta->estado=1;
        if($consulta->save()){

            $antefamilia=new AntecedentesFamiliares;
            $antefamilia->id_cone=$consulta->id_cone;
            $antefamilia->cardiopatia=($data[0]["antecedentesfamiliares"][0]["cardiopatia"]!=true)? "0" :"1";
            $antefamilia->diabetes=($data[0]["antecedentesfamiliares"][0]["diabetes"]!=true)? "0" :"1";
            $antefamilia->vascular=($data[0]["antecedentesfamiliares"][0]["vascular"]!=true)? "0" :"1";
            $antefamilia->hipertencion=($data[0]["antecedentesfamiliares"][0]["hipertencion"]!=true)? "0" :"1";
            $antefamilia->cancer=($data[0]["antecedentesfamiliares"][0]["cancer"]!=true)? "0" :"1";
            $antefamilia->tuberculosis=($data[0]["antecedentesfamiliares"][0]["tuberculosis"]!=true)? "0" :"1";
            $antefamilia->enfmental=($data[0]["antecedentesfamiliares"][0]["enfmental"]!=true)? "0" :"1";
            $antefamilia->enfinfecciosa=($data[0]["antecedentesfamiliares"][0]["enfinfecciosa"]!=true)? "0" :"1";
            $antefamilia->malformacion=($data[0]["antecedentesfamiliares"][0]["malformacion"]!=true)? "0" :"1";
            $antefamilia->otro=($data[0]["antecedentesfamiliares"][0]["otro"]!=true)? "0" :"1";
            $antefamilia->descripcion=$data[0]["antecedentesfamiliares"][0]["descripcion"];
            $antefamilia->estado=1;
            $antefamilia->save();

            $sigvitales=new SignosVitales;
            $sigvitales->id_cone=$consulta->id_cone;
            $sigvitales->fechamedicion=$data[0]["signosvitales"][0]["fechamedicion"];
            $sigvitales->temperatura=$data[0]["signosvitales"][0]["temperatura"];
            $sigvitales->presionarterial=$data[0]["signosvitales"][0]["presionarterial"];
            $sigvitales->pulso=$data[0]["signosvitales"][0]["pulso"];
            $sigvitales->frerespiratoria=$data[0]["signosvitales"][0]["frerespiratoria"];
            $sigvitales->peso=$data[0]["signosvitales"][0]["peso"];
            $sigvitales->talla=$data[0]["signosvitales"][0]["talla"];
            $sigvitales->estado=1;
            $sigvitales->save();

            $orgsistema=new OrganosSistemas;
            $orgsistema->id_cone=$consulta->id_cone;
            $orgsistema->sentidos_cp=$data[0]["organossistemas"][0]["sentidos_cp"];
            $orgsistema->sentidos_sp=$data[0]["organossistemas"][0]["sentidos_sp"];
            $orgsistema->respiratorio_cp=$data[0]["organossistemas"][0]["respiratorio_cp"];
            $orgsistema->respiratorio_sp=$data[0]["organossistemas"][0]["respiratorio_sp"];
            $orgsistema->vascular_cp=$data[0]["organossistemas"][0]["vascular_cp"];
            $orgsistema->vascular_sp=$data[0]["organossistemas"][0]["vascular_sp"];
            $orgsistema->digestivo_cp=$data[0]["organossistemas"][0]["digestivo_cp"];
            $orgsistema->digestivo_sp=$data[0]["organossistemas"][0]["digestivo_sp"];
            $orgsistema->genital_cp=$data[0]["organossistemas"][0]["genital_cp"];
            $orgsistema->genital_sp=$data[0]["organossistemas"][0]["genital_sp"];
            $orgsistema->urinario_cp=$data[0]["organossistemas"][0]["urinario_cp"];
            $orgsistema->urinario_sp=$data[0]["organossistemas"][0]["urinario_sp"];
            $orgsistema->mesqueletico_cp=$data[0]["organossistemas"][0]["mesqueletico_cp"];
            $orgsistema->mesqueletico_sp=$data[0]["organossistemas"][0]["mesqueletico_sp"];
            $orgsistema->endocrino_cp=$data[0]["organossistemas"][0]["endocrino_cp"];
            $orgsistema->endocrino_sp=$data[0]["organossistemas"][0]["endocrino_sp"];
            $orgsistema->linfatico_cp=$data[0]["organossistemas"][0]["linfatico_cp"];
            $orgsistema->linfatico_sp=$data[0]["organossistemas"][0]["linfatico_sp"];
            $orgsistema->nervioso_cp=$data[0]["organossistemas"][0]["nervioso_cp"];
            $orgsistema->nervioso_sp=$data[0]["organossistemas"][0]["nervioso_sp"];
            $orgsistema->descripcion=$data[0]["organossistemas"][0]["descripcion"];
            $orgsistema->estado=1;
            $orgsistema->save();

            $fisregional=new FisicoRegional;
            $fisregional->id_cone=$consulta->id_cone;
            $fisregional->cabeza_cp=$data[0]["fisicoregional"][0]["cabeza_cp"];
            $fisregional->cabeza_sp=$data[0]["fisicoregional"][0]["cabeza_sp"];
            $fisregional->cuello_cp=$data[0]["fisicoregional"][0]["cuello_cp"];
            $fisregional->cuello_sp=$data[0]["fisicoregional"][0]["cuello_sp"];
            $fisregional->torax_cp=$data[0]["fisicoregional"][0]["torax_cp"];
            $fisregional->torax_sp=$data[0]["fisicoregional"][0]["torax_sp"];
            $fisregional->abdomen_cp=$data[0]["fisicoregional"][0]["abdomen_cp"];
            $fisregional->abdomen_sp=$data[0]["fisicoregional"][0]["abdomen_sp"];
            $fisregional->pelvis_cp=$data[0]["fisicoregional"][0]["pelvis_cp"];
            $fisregional->pelvis_sp=$data[0]["fisicoregional"][0]["pelvis_sp"];
            $fisregional->extremidades_cp=$data[0]["fisicoregional"][0]["extremidades_cp"];
            $fisregional->extremidades_sp=$data[0]["fisicoregional"][0]["extremidades_sp"];
            $fisregional->descripcion=$data[0]["fisicoregional"][0]["descripcion"];
            $fisregional->estado=1;
            $fisregional->save();

            foreach ($data[0]["diagnostico"] as $d) {
                $diag = new Diagnostico;
                $diag->id_cone=$consulta->id_cone;
                $diag->id_ci=$d["cie"]["id_ci"];
                $diag->presuntivo=$d["presuntivo"];
                $diag->definitivo=$d["definitivo"];
                $diag->save();
            }
            $aux_data=Agenda::with("usuario.persona.personaempresa.empresa","cliente.persona","empleado.persona","consultageneral") //agregado la consulta externa
                    ->whereRaw("id_ag=".$consulta->id_ag."")
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();
            return response()->json(['success' => $aux_data]); //error al guardar la consulta
        }else{
            return response()->json(['success' => 1]); //error al guardar la consulta
        }

    }

    /**
     *
     *
     * Modificar  anamnesis 
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $consulta= ConsultaExterna::find($id);
        $consulta->motivo=$data[0]["motivo"];
        $consulta->antecedentespersonales=$data[0]["antecedentespersonales"];
        $consulta->enfermedadactual=$data[0]["enfermedadactual"];
        $consulta->planestratamiento=$data[0]["planestratamiento"];
        $consulta->data_json=json_encode($data);
        $consulta->estado=1;
        if($consulta->save()){

            $antefamilia=AntecedentesFamiliares::find($data[0]["antecedentesfamiliares"][0]["id_antf"]);
            
            $antefamilia->cardiopatia=($data[0]["antecedentesfamiliares"][0]["cardiopatia"]!=true)? "0" :"1";
            $antefamilia->diabetes=($data[0]["antecedentesfamiliares"][0]["diabetes"]!=true)? "0" :"1";
            $antefamilia->vascular=($data[0]["antecedentesfamiliares"][0]["vascular"]!=true)? "0" :"1";
            $antefamilia->hipertencion=($data[0]["antecedentesfamiliares"][0]["hipertencion"]!=true)? "0" :"1";
            $antefamilia->cancer=($data[0]["antecedentesfamiliares"][0]["cancer"]!=true)? "0" :"1";
            $antefamilia->tuberculosis=($data[0]["antecedentesfamiliares"][0]["tuberculosis"]!=true)? "0" :"1";
            $antefamilia->enfmental=($data[0]["antecedentesfamiliares"][0]["enfmental"]!=true)? "0" :"1";
            $antefamilia->enfinfecciosa=($data[0]["antecedentesfamiliares"][0]["enfinfecciosa"]!=true)? "0" :"1";
            $antefamilia->malformacion=($data[0]["antecedentesfamiliares"][0]["malformacion"]!=true)? "0" :"1";
            $antefamilia->otro=($data[0]["antecedentesfamiliares"][0]["otro"]!=true)? "0" :"1";
            $antefamilia->descripcion=$data[0]["antecedentesfamiliares"][0]["descripcion"];
            $antefamilia->estado=1;
            $antefamilia->save();

            $sigvitales= SignosVitales::find($data[0]["signosvitales"][0]["id_sigv"]);
            $sigvitales->fechamedicion=$data[0]["signosvitales"][0]["fechamedicion"];
            $sigvitales->temperatura=$data[0]["signosvitales"][0]["temperatura"];
            $sigvitales->presionarterial=$data[0]["signosvitales"][0]["presionarterial"];
            $sigvitales->pulso=$data[0]["signosvitales"][0]["pulso"];
            $sigvitales->frerespiratoria=$data[0]["signosvitales"][0]["frerespiratoria"];
            $sigvitales->peso=$data[0]["signosvitales"][0]["peso"];
            $sigvitales->talla=$data[0]["signosvitales"][0]["talla"];
            $sigvitales->estado=1;
            $sigvitales->save();

            $orgsistema=OrganosSistemas::find($data[0]["organossistemas"][0]["id_orgs"]);
            $orgsistema->sentidos_cp=$data[0]["organossistemas"][0]["sentidos_cp"];
            $orgsistema->sentidos_sp=$data[0]["organossistemas"][0]["sentidos_sp"];
            $orgsistema->respiratorio_cp=$data[0]["organossistemas"][0]["respiratorio_cp"];
            $orgsistema->respiratorio_sp=$data[0]["organossistemas"][0]["respiratorio_sp"];
            $orgsistema->vascular_cp=$data[0]["organossistemas"][0]["vascular_cp"];
            $orgsistema->vascular_sp=$data[0]["organossistemas"][0]["vascular_sp"];
            $orgsistema->digestivo_cp=$data[0]["organossistemas"][0]["digestivo_cp"];
            $orgsistema->digestivo_sp=$data[0]["organossistemas"][0]["digestivo_sp"];
            $orgsistema->genital_cp=$data[0]["organossistemas"][0]["genital_cp"];
            $orgsistema->genital_sp=$data[0]["organossistemas"][0]["genital_sp"];
            $orgsistema->urinario_cp=$data[0]["organossistemas"][0]["urinario_cp"];
            $orgsistema->urinario_sp=$data[0]["organossistemas"][0]["urinario_sp"];
            $orgsistema->mesqueletico_cp=$data[0]["organossistemas"][0]["mesqueletico_cp"];
            $orgsistema->mesqueletico_sp=$data[0]["organossistemas"][0]["mesqueletico_sp"];
            $orgsistema->endocrino_cp=$data[0]["organossistemas"][0]["endocrino_cp"];
            $orgsistema->endocrino_sp=$data[0]["organossistemas"][0]["endocrino_sp"];
            $orgsistema->linfatico_cp=$data[0]["organossistemas"][0]["linfatico_cp"];
            $orgsistema->linfatico_sp=$data[0]["organossistemas"][0]["linfatico_sp"];
            $orgsistema->nervioso_cp=$data[0]["organossistemas"][0]["nervioso_cp"];
            $orgsistema->nervioso_sp=$data[0]["organossistemas"][0]["nervioso_sp"];
            $orgsistema->descripcion=$data[0]["organossistemas"][0]["descripcion"];
            $orgsistema->estado=1;
            $orgsistema->save();

            $fisregional= FisicoRegional::find($data[0]["fisicoregional"][0]["id_freg"]);
            $fisregional->cabeza_cp=$data[0]["fisicoregional"][0]["cabeza_cp"];
            $fisregional->cabeza_sp=$data[0]["fisicoregional"][0]["cabeza_sp"];
            $fisregional->cuello_cp=$data[0]["fisicoregional"][0]["cuello_cp"];
            $fisregional->cuello_sp=$data[0]["fisicoregional"][0]["cuello_sp"];
            $fisregional->torax_cp=$data[0]["fisicoregional"][0]["torax_cp"];
            $fisregional->torax_sp=$data[0]["fisicoregional"][0]["torax_sp"];
            $fisregional->abdomen_cp=$data[0]["fisicoregional"][0]["abdomen_cp"];
            $fisregional->abdomen_sp=$data[0]["fisicoregional"][0]["abdomen_sp"];
            $fisregional->pelvis_cp=$data[0]["fisicoregional"][0]["pelvis_cp"];
            $fisregional->pelvis_sp=$data[0]["fisicoregional"][0]["pelvis_sp"];
            $fisregional->extremidades_cp=$data[0]["fisicoregional"][0]["extremidades_cp"];
            $fisregional->extremidades_sp=$data[0]["fisicoregional"][0]["extremidades_sp"];
            $fisregional->descripcion=$data[0]["fisicoregional"][0]["descripcion"];
            $fisregional->estado=1;
            $fisregional->save();

            $aux_diag=Diagnostico::WhereRaw("id_cone=".$consulta->id_cone."")->delete();

            foreach ($data[0]["diagnostico"] as $d) {
                $diag = new Diagnostico;
                $diag->id_cone=$consulta->id_cone;
                $diag->id_ci=$d["cie"]["id_ci"];
                $diag->presuntivo=$d["presuntivo"];
                $diag->definitivo=$d["definitivo"];
                $diag->save();
            }



            return response()->json(['success' => 0]); //error al guardar la consulta
        }else{
            return response()->json(['success' => 1]); //error al guardar la consulta
        }

    }
    /**
     *
     *
     * cambiar estado de la anamnesis
     *
     */
    public function modify_estado($texto)
    {
        // modifica el estado de la cita para dar finalizado a la consulta externa
        $datos = json_decode($texto);
        $cone=Agenda::find($datos->id_ag);
        $cone->gestion=$datos->estado; // estado 2 para finalizado la cita y a su vez la consulta
        if($cone->save()){
            return response()->json(['success' => 0]); //ok
        }else{
            return response()->json(['success' => 1]); //error al modificar el estado
        }
    }
    /**
     * Imprimir anamanesis
     * 
     * 
     */
    public function print_anamnesis($parametro)
    {   
        ini_set('max_execution_time', 300);
        $filtro = json_decode($parametro);
        $anamnesis=$this->get_anamnesistoid($parametro);
        
        $agenda=Agenda::with("usuario.persona.personaempresa.empresa","cliente.persona","empleado.persona","consultageneral") //agregado la consulta externa
                    ->whereRaw("id_ag=".$filtro->id_ag."")
                    ->orderBy("agenda.horainicio","ASC")
                    ->get();

        $today=date("Y-m-d H:i:s");
        $view =  \View::make('Print.Anamnesis', compact('filtro','anamnesis','today','agenda'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream("anamnesis_".$today."");
    }

     /**
     *
     * estadistica de tipo de enfermedades comunes
     *
     */
    public function data_enfermedadesfamiliares()
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        $tomonth="20".date("y-m");

        
        $sql=" AND id_cone IN (SELECT consulta_externa.id_cone FROM consulta_externa  WHERE consulta_externa.id_ag  IN ( ";
        $sql.=" SELECT agenda.id_ag FROM agenda WHERE agenda.fecha LIKE '%".$tomonth."%' AND agenda.id_em=".$id_emp.")) ";

        $cardiopatia = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" cardiopatia<>0 ".$sql)
                                            ->get();

        $diabetes = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" diabetes<>0 ".$sql)
                                            ->get();

        $vascular = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" vascular<>0 ".$sql)
                                            ->get();

        $hipertencion = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" hipertencion<>0 ".$sql)
                                            ->get();

        $cancer = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" cancer<>0 ".$sql)
                                            ->get();

        $tuberculosis = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" tuberculosis<>0 ".$sql)
                                            ->get();

        $enfinfecciosa = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" enfinfecciosa<>0 ".$sql)
                                            ->get();

        $enfmental = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" enfmental<>0 ".$sql)
                                            ->get();

        $malformacion = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" malformacion<>0 ".$sql)
                                            ->get();

        $otro = AntecedentesFamiliares::selectRaw(" COUNT(*) AS Cantidad ")
                                            ->whereRaw(" otro<>0 ".$sql)
                                            ->get();
        return  $arrayName = array(
                        'Cardiopatia' => $cardiopatia[0]->Cantidad ,
                        'Diabetes' => $diabetes[0]->Cantidad ,
                        'Vascular' => $vascular[0]->Cantidad ,
                        'Hipertencion' => $hipertencion[0]->Cantidad ,
                        'Cancer' => $cancer[0]->Cantidad ,
                        'Tuberculosis' => $tuberculosis[0]->Cantidad ,
                        'Enfermedad_mental' => $enfmental[0]->Cantidad ,
                        'Enfermedad_infecciosa' => $enfinfecciosa[0]->Cantidad ,
                        'Malformacion' => $malformacion[0]->Cantidad ,
                        'Otro' => $otro[0]->Cantidad 
                         );
    }

      /**
     *
     * estadistica de diagnosticos
     *
     */
    public function data_diagnosticos()
    {
        $data_user=Session::get('user_data');
        $id_emp=$data_user[0]->persona->personaempresa[0]->id_emp;
        $tomonth="20".date("y-m");

        
        $sql=" IN (SELECT consulta_externa.id_cone FROM consulta_externa  WHERE consulta_externa.id_ag  IN ( ";
        $sql.=" SELECT agenda.id_ag FROM agenda WHERE agenda.fecha LIKE '%".$tomonth."%' AND agenda.id_em=".$id_emp.")) ";

        return Diagnostico::selectRaw(" (SELECT cie.descripcion FROM cie WHERE cie.id_ci=diagnostico.id_ci) AS Diagnosticos ")
                            ->selectRaw(" (SELECT COUNT(*)  FROM diagnostico aux_di WHERE aux_di.id_ci=diagnostico.id_ci AND aux_di.id_cone ".$sql." )  AS Cantidad ")
                            ->whereRaw(" diagnostico.id_cone ".$sql." ")
                            ->groupBy("diagnostico.id_ci")
                            ->get();
    }

}
