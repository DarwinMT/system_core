app.controller('LogicaAgenda', function($scope, $http, API_URL,Upload) {
    $scope.Title="Agendar Citas";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.fecha_inicial="2017-10-01";
    $scope.tipo_calendar="M";
    $scope.meses_letras=["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];

    ///---
    $scope.crear_fechas_control=function(action) {
        var f = new Date();
        var desde="";
        var hasta="";
        switch(action){
            case "M":
                desde=f.getFullYear()+"-";
                desde+=((f.getMonth()+1)<10) ? "0"+(f.getMonth()+1):(f.getMonth()+1)+"-";
                desde+="01";
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                var aux_ultimodia_mes=new Date(f.getMonth(),(f.getMonth()-1),0);
                hasta=f.getFullYear()+"-";
                hasta+=((f.getMonth()+1)<10) ? "0"+(f.getMonth()+1):(f.getMonth()+1)+"-";
                hasta+=aux_ultimodia_mes.getDate();

                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;
            break;
            case "D":
                desde=f.getFullYear()+"-";
                desde+=((f.getMonth()+1)<10) ? "0"+(f.getMonth()+1):(f.getMonth()+1)+"-";
                desde+=((f.getDate())<10) ? "0"+(f.getDate()):(f.getDate());
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                hasta=desde;
                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;
            break;
            case "Y":
                desde=f.getFullYear()+"-";
                desde+="01"+"-";
                desde+="01";
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                hasta=f.getFullYear()+"-";
                hasta+="12"+"-";
                hasta+="31";

                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;
            break;
            case "S":
                
                var primerdia=new Date(f.getFullYear(),f.getMonth(),f.getDate());
                primerdia.setDate((f.getDate()- f.getDay()));
                
                var ultimodia=new Date(f.getFullYear(),f.getMonth(),f.getDate());
                ultimodia.setDate((f.getDate()+ (6-f.getDay())));
                
                desde=primerdia.getFullYear()+"-";
                desde+=((primerdia.getMonth()+1)<10) ? "0"+(primerdia.getMonth()+1):(primerdia.getMonth()+1)+"-";
                desde+=((primerdia.getDate())<10) ? "0"+(primerdia.getDate()):(primerdia.getDate());
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                hasta=ultimodia.getFullYear()+"-";
                hasta+=((ultimodia.getMonth()+1)<10) ? "0"+(ultimodia.getMonth()+1):(ultimodia.getMonth()+1)+"-";
                hasta+=((ultimodia.getDate())<10) ? "0"+(ultimodia.getDate()):(ultimodia.getDate());

                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;
                

            break;
        };  
    };

    $scope.control_panel=function (action) {
        $("#btn_mes").removeClass("active");
        $("#btn_dia").removeClass("active");
        $("#btn_year").removeClass("active");
        $("#btn_semana").removeClass("active");
        switch(action){
            case "M":
                $scope.tipo_calendar=action;
                $("#btn_mes").addClass("active");
                $scope.crear_fechas_control(action);
            break;
            case "D":
                $scope.tipo_calendar=action;
                $("#btn_dia").addClass("active");
                $scope.crear_fechas_control(action);
            break;
            case "Y":
                $scope.tipo_calendar=action;
                $("#btn_year").addClass("active");
                $scope.crear_fechas_control(action);
            break;
            case "S":
                $scope.tipo_calendar=action;
                $("#btn_semana").addClass("active");
                $scope.crear_fechas_control(action);
            break;
        };
    };
    $scope.control_panel("M");

    
    ///---



    ///--- crear calendario mensual
    $scope.mes=[];
    $scope.calendar=function(fecha_init){
        var today=new Date();

        $scope.mes=[];
        var aux=fecha_init.split("-");
        var feha=new Date(parseInt(aux[0]), (parseInt(aux[1])-1) , 1 );

        var fecha_inicial = new Date(feha.getFullYear(), feha.getMonth(), 1);
        var fecha_final = new Date(feha.getFullYear(), feha.getMonth() + 1, 0);


        var aux_d=0;
        var primer_dia=1;
        var aux_semanas=1;
        var dias=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];

        var semana1=[];
        var semana2=[];
        var semana3=[];
        var semana4=[];
        var semana5=[];
        var semana6=[];
        for(var x=1; x<=fecha_final.getDate();x++){

            var hoy_actual=0;
            if(x==today.getDate()){
                hoy_actual=1;
            }
            if(aux_d<=6){
                

                var aux_fecha= new Date(fecha_final.getFullYear(), fecha_final.getMonth(), x);

                switch(aux_semanas){
                    case 1:
                        if(aux_fecha.getDay()!=0 && x==1){ //diferente de domingo 
                            for(var i=0;i<aux_fecha.getDay();i++){
                                var dia={
                                    Id:'',
                                    Numero_dia:'',
                                    Numero_Citas:'',
                                    Hoy:hoy_actual
                                };
                                semana1.push(dia);
                                aux_d++;
                            }

                            var dia={
                                    Id:'',
                                    Numero_dia:x,
                                    Numero_Citas:'8',
                                    Hoy:hoy_actual
                                };
                            semana1.push(dia);

                        }else{
                            if(semana1.length<=6){
                                var dia={
                                    Id:'',
                                    Numero_dia:x,
                                    Numero_Citas:'8',
                                    Hoy:hoy_actual
                                };
                                semana1.push(dia);
                                
                            }else{

                            }


                        }


                    break;

                    case 2:

                    
                            var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'12',
                                Hoy:hoy_actual
                            };
                            semana2.push(dia);
                    
                    break;
                    case 3:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'5',
                                Hoy:hoy_actual
                            };
                        semana3.push(dia);
                        
                    break;
                    case 4:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'741',
                                Hoy:hoy_actual
                            };
                        semana4.push(dia);                        
                    break;
                    case 5:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'798',
                                Hoy:hoy_actual
                            };
                        semana5.push(dia);                        
                    break;
                    case 6:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'8555',
                                Hoy:hoy_actual
                            };
                        semana6.push(dia);                        
                    break;
                }

            }else{

               

                aux_semanas++;
                switch(aux_semanas){
                    case 2:
                            var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'13',
                                Hoy:hoy_actual
                            };
                            semana2.push(dia)
                    break;
                    case 3:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'1',
                                Hoy:hoy_actual
                            };
                        semana3.push(dia);
                    break;
                    
                    case 4:
                        var dia={
                            Id:'',
                            Numero_dia:x,
                            Numero_Citas:'1222',
                            Hoy:hoy_actual
                        };
                        semana4.push(dia);
                    break;

                    case 5:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'-551',
                                Hoy:hoy_actual
                            };
                        semana5.push(dia);
                    break;
                    case 6:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'-55',
                                Hoy:hoy_actual
                            };
                        semana6.push(dia);                        
                    break;
                }

                aux_d=0;
                


            }
            aux_d++;
        }

        $scope.mes.push(semana1);
        $scope.mes.push(semana2);
        $scope.mes.push(semana3);
        $scope.mes.push(semana4);
        $scope.mes.push(semana5);
        $scope.mes.push(semana6);
    };
    ///--- crear calendario mensual

    ///--- retroceder y adelantar calendario
    $scope.back_calendar=function(){

        switch($scope.tipo_calendar){
            case "M": // mensual
                var aux_mes= $scope.fecha_inicial;
                var aux = aux_mes.split("-");
                var fecha_back= new Date(parseInt(aux[0]), (parseInt(aux[1]) -1 ),1);
                var dayOfMonth = fecha_back.getMonth();
                fecha_back.setMonth(dayOfMonth-1); //restar mes
                var aux_mes_suma=(fecha_back.getMonth()+1);
                var aux_mes = (aux_mes_suma.toString().length==1)? "0"+(aux_mes_suma):(aux_mes_suma);
                var aux_dias = (fecha_back.getDate().toString().length==1)? "0"+fecha_back.getDate():fecha_back.getDate();
                $scope.fecha_inicial=fecha_back.getFullYear()+"-"+aux_mes+"-"+aux_dias;
                $scope.calendar($scope.fecha_inicial);
            break;
        };
        $scope.titulo_fecha();
    };

    $scope.nex_calendar=function(){
        switch($scope.tipo_calendar){
            case "M": // mensual
                var aux_mes= $scope.fecha_inicial;
                var aux = aux_mes.split("-");
                
                var fecha_next= new Date(parseInt(aux[0]), (parseInt(aux[1])-1),1);
                var dayOfMonth2 = fecha_next.getMonth();
                fecha_next.setMonth(dayOfMonth2 + 1); //sumar mes

                var aux_mes_suma=(fecha_next.getMonth()+1);
                var aux_mes = (aux_mes_suma.toString().length==1)? "0"+(aux_mes_suma):(aux_mes_suma);
                var aux_dias = (fecha_next.getDate().toString().length==1)? "0"+fecha_next.getDate():fecha_next.getDate();
                $scope.fecha_inicial=fecha_next.getFullYear()+"-"+aux_mes+"-"+aux_dias;
                $scope.calendar($scope.fecha_inicial);
            break;
        };
        $scope.titulo_fecha();
    };

    $scope.Fecha_Select="";
    $scope.titulo_fecha=function(){
        var aux = $scope.fecha_inicial.split("-");
        switch($scope.tipo_calendar){
            case "M":
                $scope.Fecha_Select=($scope.meses_letras[(parseInt(aux[1]-1))])+" Del "+aux[0];
            break;
        };

    };
    ///--- retroceder y adelantar calendario

    $scope.calendar($scope.fecha_inicial);
    $scope.titulo_fecha();


    ///--- Init crear agenda 

    $scope.nombreempleado="";
    $scope.aux_empleado=null;

    $scope.nombrecliente="";
    $scope.aux_cliente=null;

    $scope.tipoagenda="1";


        ///--- buscar medico
            $scope.buscar_empleado=function(){

                $("#md_medico").modal("show");
                $scope.buscar_employed(1);
            };


            ///--- lista de empleados
            $scope.buscartexto_empleado="";
            $scope.estadoanulado="1";
            $scope.list_empleados=[];

            $scope.pageChanged_empleado = function(newPage) {
                $scope.buscar_employed(newPage);
            };
            $scope.buscar_employed = function(pageNumber){

                var filtros = {
                    buscar:$scope.buscartexto_empleado,
                    estado: $scope.estadoanulado
                };
                $http.get(API_URL + 'Empleado/get_list_empleado?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
                    .then(function(response){
                        $scope.list_empleados = response.data.data;
                        $scope.totalItems = response.data.total;
                        console.log($scope.list_empleados);
                 });
            };    
            ///--- lista de empleados

            ///--- seleccionar empleado
            $scope.select_empleado=function(item){
                
                $scope.nombreempleado="";
                $scope.aux_empleado=null;


                $scope.aux_empleado=item;
                $scope.nombreempleado=item.persona.apellido+" "+item.persona.nombre;
                
                $("#md_medico").modal("hide");
            };

            ///--- buscar medico


            ///--- seleccionar empleado


            ///--- lista de cliente 
            $scope.buscartexto_cliente="";
        
            $scope.list_cliente=[];
            $scope.pageChanged_cliente = function(newPage) {
                $scope.initLoad_cliente(newPage);
            };
            $scope.initLoad_cliente = function(pageNumber){

                var filtros = {
                    buscar:$scope.buscartexto_cliente,
                    estado: "1"
                };
                $http.get(API_URL + 'Cliente/get_list_cliente?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
                    .then(function(response){
                        $scope.list_cliente = response.data.data;
                        $scope.totalItems = response.data.total;
                        console.log($scope.list_cliente);
                 });
            };
            ///--- lista de cliente 

            ///--- modal cliente
            $scope.buscar_cliente=function(){
                $("#md_cliente").modal("show");

                $scope.pageChanged_cliente(1);
            };
            ///--- modal cliente

            ///--- seleccione cliente
            $scope.select_cliente=function(item){
                $scope.nombrecliente="";
                $scope.aux_cliente=null; 

                
                $scope.aux_cliente=item;
                $scope.nombrecliente=item.persona.apellido+" "+item.persona.nombre;

                $("#md_cliente").modal("hide");

            };
            ///--- seleccione cliente


            ///--- configuracion empresa 
            $scope.config_all=[];

            $scope.get_config_all=function () {
                $http.get(API_URL + 'Agenda/Configuracion')
                .success(function(response){
                    $scope.config_all=response;
                    console.log($scope.config_all);
                    $scope.make_time();
                });
            };
            $scope.get_config_all();
            ///--- configuracion empresa 


        
    ///--- end crear agenda 

    ///--- generar horas
    $scope.horas_general=[];
    $scope.make_time=function() {
        $scope.horas_general=[];
        var hora_init="";
        var hora_end="";
        var intervalo="";

        $scope.config_all.forEach(function(t){
            switch(t.identificador){
                case "RG_HORA_INICIO_AGENDA":
                    hora_init=t.valor;
                break;
                case "RG_HORA_FIN_AGENDA":
                    hora_end=t.valor;
                break;
                case "RG_INTERVALO_AGENDA":
                    intervalo=t.valor;
                break;
            }
        });

        var aux_hora_init=hora_init.split(":");
        var aux_hora_end=hora_end.split(":");

        var aux_interval=intervalo.split(":");

        console.log(aux_interval[0])

        for(var i=parseInt(aux_hora_init[0]); i<=parseInt(aux_hora_end[0]); i++ ){
            for(var j=0; j<60; j+=parseInt(aux_interval[0]) ){

                var hora1=(i.toString().length==1)? "0"+i: i;
                var minuto1=(j.toString().length==1)? "0"+j: j;
                var time =hora1+":"+minuto1;

                $scope.horas_general.push(time);
            }
        }

        
    };
    ///--- generar horas

    ///--- buscar horas disponibles 
    $('#fechacita').on('dp.change', function(e){
        $scope.make_time();
        $scope.fechacita=$(this).val(); 
        $scope.buscar_horas_libres_empleado();
    });

    $scope.buscar_horas_libres_empleado=function () {
        
        if($scope.aux_empleado!=null){
            if($scope.aux_cliente!=null){
                var filtro={
                    id_emp: $scope.aux_empleado.id_emp,
                    id_cli: $scope.aux_cliente.id_cli,
                    fecha: $('#fechacita').val()
                }
                $scope.load_tiempo(filtro);
            }else{
                sms("btn-warning","Seleccione un cliente");    
            }
        }else{
            sms("btn-warning","Seleccione un medico");
        }
    };
    $scope.limpiar_cliente=function() {
        $scope.nombrecliente="";
        $scope.aux_cliente=null;
    };
    $scope.limpiar_empleado=function() {
        $scope.nombreempleado="";
        $scope.aux_empleado=null;
    };
    $scope.load_tiempo=function(filter) {
        if($scope.aux_empleado!=null){
            if($scope.aux_cliente!=null){
                if($("#fechacita").val()!=""){
                    if($scope.tipoagenda=="1"){ // solo si la agenda es normal // 1 normal 2 emeregencia y debe permitir agedar
                        $scope.load_tiempo_agenda_persona(filter);
                    }
                }else{
                    sms("btn-warning","Seleccione una fecha");
                }
            }else{
                sms("btn-warning","Seleccione un cliente");    
            }
        }else{
            sms("btn-warning","Seleccione un medico");
        }

    };
    $scope.load_tiempo_agenda_persona=function(data) {
        $http.get(API_URL + 'Agenda/get_horas_ocupadas_persona/' + JSON.stringify(data))
            .then(function(response){
                var aux_horas=response.data;
                aux_horas.forEach(function(h){
                    var aux_time=h.horainicio.toString().split(":");
                    var hora=aux_time[0]+":"+aux_time[1];
                    var posicion= $scope.horas_general.indexOf(hora);
                    $scope.horas_general.splice(posicion,1);
                });
        });  
    };
    ///--- buscar horas disponibles

    ///--- guardar agenda
    $scope.save_agenda=function() {
        $("#progress").modal("show");
        var f=new Date();
        var today=f.getFullYear()+"-"+(f.getMonth()+1)+"-"+f.getDate();
        var agenda={
            id_em: 0,
            id_u: 0,
            id_cli: $scope.aux_cliente.id_cli,
            id_emp: $scope.aux_empleado.id_emp,
            turno: 0,
            fechacreacion: today,
            fecha: $scope.fechacita,
            horainicio: $scope.hora,
            horafin: '',
            observacion: $scope.observacion,
            tipo: $scope.tipoagenda, // 1 normal , 2 emergencia 
            gestion:1, // 1, sin gestionar 2, gestionada o finalizada
            estado: 1 // 1 activa, 0 inactiva 
        };
        $http.post(API_URL + 'Agenda',agenda)
        .success(function(response){
            console.log(response);
            $("#progress").modal("hide");
            if(response.success==0){
                sms("btn-success","Se guardo correctamente los datos..!!");
                $scope.clear_agenda();
            }else{
                sms("btn-danger","Error al guardar los datos..!!");
                $scope.clear_agenda();
            }
        });
    };

    $scope.clear_agenda=function() {
        $scope.limpiar_cliente();
        $scope.limpiar_empleado();
        $scope.make_time();
        $scope.tipoagenda="1";
        $("#fechacita").val("");
        $scope.fechacita="";
        $scope.observacion="";
        $scope.hora="";

    };
    ///--- guardar agenda

});

function sms(color,mensaje) {
    head_msm();
    $("#titulomsm").addClass(color);
    $("#sms").modal("show");
    $("#smsb").html(mensaje);
}

function convertDatetoDB(now, revert){
    if (revert == undefined){
        var t = now.split('/');
        return t[2] + '-' + t[1] + '-' + t[0];
    } else {
        var t = now.split('-');
        return t[2] + '/' + t[1] + '/' + t[0];
    }
}

function now(){
    var now = new Date();
    var dd = now.getDate();
    if (dd < 10) dd = '0' + dd;
    var mm = now.getMonth() + 1;
    if (mm < 10) mm = '0' + mm;
    var yyyy = now.getFullYear();
    return dd + "\/" + mm + "\/" + yyyy;
}
function first(){
    var now = new Date();
    var yyyy = now.getFullYear();
    return "01/01/"+ yyyy;
}

function completarNumer(valor){
    if(valor.toString().length>0){
        var i=5;
        var completa="0";
        var aux_com=i-valor.toString().length;
        for(x=0;x<aux_com;x++){
            completa+="0";
        }
    }
    return completa+valor.toString();
}

function head_msm() {
    $("#titulomsm").removeClass("btn-primary");
    $("#titulomsm").removeClass("btn-warning");
    $("#titulomsm").removeClass("btn-success");
    $("#titulomsm").removeClass("btn-info");
    $("#titulomsm").removeClass("btn-danger");
}
$(document).ready(function(){
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });
});