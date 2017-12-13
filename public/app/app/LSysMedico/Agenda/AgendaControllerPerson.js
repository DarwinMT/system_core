app.controller('LogicaAgendaPerson', function($scope, $http, API_URL,Upload) {
    $scope.Title="Agenda De Citas ";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    });


    //$scope.fecha_inicial="2017-10-01";
    var fecha_referencial = new Date();
    $scope.fecha_referencial_angular = new Date();
    var mes_referencia=(((fecha_referencial.getMonth()+1)<10)? "0"+(fecha_referencial.getMonth()+1):(fecha_referencial.getMonth()+1));
    $scope.fecha_inicial=fecha_referencial.getFullYear()+"-"+mes_referencia+"-01";

    $scope.tipo_calendar="D";
    $scope.meses_letras=["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];

    $scope.empleadoagenda="";
    $scope.estadoanuladoagenda="1";

    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Agenda')
        .success(function(response){
            console.log(response[0].id_men);
            if(response[0].id_men!= undefined  ){ // no tiene session activa
                $scope.list_permisos=response[0];
            }else{
                location.reload();
            }
        });
    };
    ///--- datos de usuario para la agenda
    $scope.user_agenda={};
    $scope.get_user_agenda=function () {
        $http.get(API_URL + 'Agenda/get_user_agenda')
            .success(function(response){
                console.log(response);
                $scope.user_agenda=response[0];
                $scope.select_empleado($scope.user_agenda);
                $scope.empleadoagenda=String($scope.user_agenda.id_emp);
                $scope.control_panel($scope.tipo_calendar, $scope.fecha_referencial_angular);
                $scope.Title="Agenda De Citas De "+$scope.user_agenda.persona.apellido+" "+$scope.user_agenda.persona.nombre;
            });
    };
    $scope.get_user_agenda();
    ///--- datos de usuario para la agenda
    ///--- configuracion empresa 
    $scope.config_all=[];

    $scope.get_config_all=function () {
        $http.get(API_URL + 'Agenda/Configuracion')
        .success(function(response){
            $scope.config_all=response;
            $scope.make_time();
        });
    };
    $scope.get_config_all();
    ///--- configuracion empresa 


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


    ///--- agenda diaria
    $scope.list_agend_day=[];
    $scope.make_day=function(fecha){
        var filtro_cita={
            Fecha: fecha,
            id_emp: $scope.empleadoagenda,
            estado: $scope.estadoanuladoagenda
        };
        $scope.list_info_day=[];
        $http.get(API_URL + 'Agenda/get_info_agenda_mensual/' + JSON.stringify(filtro_cita))
            .then(function(response){
                console.log(response.data);
                $scope.list_agend_day=response.data;
        }); 
    }
    ///--- agenda diaria

    ///--- calendario semanal
    $scope.list_citas_semana=[];
    $scope.list_dias_citas_semana=[];
    $scope.make_week=function (fecha_i,fecha_f,data) {
        var aux_dia_i=fecha_i.split("-");
        var aux_dia_f=fecha_f.split("-");
        var today=new Date();

        
        var fecha_init=new Date(parseInt(aux_dia_i[0]), (parseInt(aux_dia_i[1]) -1 ), parseInt(aux_dia_i[2]));

        var fecha_end=new Date(parseInt(aux_dia_f[0]), (parseInt(aux_dia_f[1]) -1 ), parseInt(aux_dia_f[2]));




        $scope.list_citas_semana=[];
        $scope.list_dias_citas_semana=[];
        var aux_dia=1;
        var aux_hora=1;
        data.Horas.forEach(function(h){
            var lista_dias=[];

            while(fecha_init<=fecha_end){

                var hoy_actual=0;
                if(fecha_init.getDate()==today.getDate()){
                    hoy_actual=1;
                }
                if(aux_hora==1){
                    var horas={
                        time:h.horainicio
                    };
                    lista_dias.push(horas);
                }
                var dia={
                        Id:'',
                        Numero_dia:fecha_init.getDate(),
                        Hora:h.horainicio, 
                        Numero_Citas:'',
                        Hoy:hoy_actual, 
                        Fecha: (aux_dia_i[0]+"-"+aux_dia_i[1]+"-"+( (fecha_init.getDate()<10)? ("0"+fecha_init.getDate()):fecha_init.getDate() ) )
                    };
                    lista_dias.push(dia);
                    if(aux_dia==1) $scope.list_dias_citas_semana.push(fecha_init.getDate());
                    aux_hora++;

                fecha_init.setDate(fecha_init.getDate()+1);
                

            }
            $scope.list_citas_semana.push(lista_dias);
            aux_dia++;
            aux_hora=1;
            fecha_init=new Date(parseInt(aux_dia_i[0]), (parseInt(aux_dia_i[1]) -1 ), parseInt(aux_dia_i[2]));
            fecha_end=new Date(parseInt(aux_dia_f[0]), (parseInt(aux_dia_f[1]) -1 ), parseInt(aux_dia_f[2]));

        });

        console.log($scope.list_citas_semana);

        $scope.list_citas_semana.forEach(function(c){
            c.forEach(function(d){
                if(d.Hora!=undefined){
                    var nummerocitas=0;
                    data.Citas.forEach(function(a){
                        if(a.fecha==d.Fecha && a.horainicio==d.Hora){
                           nummerocitas++; 
                        }
                    });
                    d.Numero_Citas=nummerocitas;
                }
            });
        });        
        
        
    };
    $scope.week=function (fecha_i,fecha_f) {
        /*var filtro={
            id_emp: $scope.empleadoagenda,
            fechaI: $scope.fecha_desde,
            fechaF: $scope.fecha_hasta
        };*/
        var filtro={
            id_emp: $scope.empleadoagenda,
            fechaI: fecha_i,
            fechaF: fecha_f,
            estado: $scope.estadoanuladoagenda
        };
        $scope.list_agenda_mensual=[];
        $http.get(API_URL + 'Agenda/get_agenda_semana/' + JSON.stringify(filtro))
            .then(function(response){
                console.log(response.data)
                $scope.make_week(fecha_i,fecha_f,response.data);
        });
    };
    ///--- calendario semanal

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
                                    Hoy:hoy_actual, 
                                    Fecha: (aux[0]+"-"+aux[1]+"" )
                                };
                                semana1.push(dia);
                                aux_d++;
                            }

                            var dia={
                                    Id:'',
                                    Numero_dia:x,
                                    Numero_Citas:'',
                                    Hoy:hoy_actual,
                                    Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                                };
                            semana1.push(dia);

                        }else{
                            if(semana1.length<=6){
                                var dia={
                                    Id:'',
                                    Numero_dia:x,
                                    Numero_Citas:'',
                                    Hoy:hoy_actual,
                                    Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
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
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                            semana2.push(dia);
                    
                    break;
                    case 3:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                        semana3.push(dia);
                        
                    break;
                    case 4:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                        semana4.push(dia);                        
                    break;
                    case 5:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                        semana5.push(dia);                        
                    break;
                    case 6:aux

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
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
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                            semana2.push(dia)
                    break;
                    case 3:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                        semana3.push(dia);
                    break;
                    
                    case 4:
                        var dia={
                            Id:'',
                            Numero_dia:x,
                            Numero_Citas:'',
                            Hoy:hoy_actual,
                            Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                        };
                        semana4.push(dia);
                    break;

                    case 5:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
                            };
                        semana5.push(dia);
                    break;
                    case 6:

                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'',
                                Hoy:hoy_actual,
                                Fecha: (aux[0]+"-"+aux[1]+"-"+( (x<10)? "0"+x:x ) )
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

    ///--- agenda por mes
    $scope.list_agenda_mensual=[]; 
    $scope.ageda_mensual=function function_name() {

        var filtro={
            id_emp: $scope.empleadoagenda,
            fechaI: $scope.fecha_desde,
            fechaF: $scope.fecha_hasta,
            estado: $scope.estadoanuladoagenda
        };
        $scope.list_agenda_mensual=[];
        $http.get(API_URL + 'Agenda/get_agenda_mensual/' + JSON.stringify(filtro))
            .then(function(response){
                $scope.list_agenda_mensual = response.data;
                

                $scope.mes.forEach(function(m) {
                    m.forEach(function(d){
                        $scope.list_agenda_mensual.forEach(function(c){
                            if(d.Fecha==c.fecha && c.NumeroCita>0){
                                d.Numero_Citas=c.NumeroCita;
                            }
                        });
                    });
                });


        });
        
    };
    ///--- agenda por mes 

    ///---
    $scope.crear_fechas_control=function(action, f) {
        if(f!=null){
            fecha_referencial=f;
            $scope.fecha_referencial_angular=f;
        }else{
            f=new Date();
            fecha_referencial=f;
            $scope.fecha_referencial_angular=f;
        }
        
        //var f = new Date();
        var desde="";
        var hasta="";
        switch(action){
            case "M":

                desde=f.getFullYear()+"-";
                desde+=((f.getMonth()+1)<10) ? "0"+(f.getMonth()+1):(f.getMonth()+1);
                desde+="-01";
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                var aux_ultimodia_mes=new Date(f.getFullYear(),(f.getMonth()+1),0);
                
                hasta=f.getFullYear()+"-";
                hasta+=((f.getMonth()+1)<10) ? "0"+(f.getMonth()+1):(f.getMonth()+1);
                hasta+="-"+aux_ultimodia_mes.getDate();

                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;

                $scope.fecha_inicial=$scope.fecha_desde;
                $scope.calendar($scope.fecha_inicial);

                $scope.ageda_mensual();
            break;
            case "D":
                desde=f.getFullYear()+"-";
                desde+=(((f.getMonth()+1)<10) ? "0"+(f.getMonth()+1):(f.getMonth()+1)).toString()+"-";
                desde+=((f.getDate())<10) ? "0"+(f.getDate()):(f.getDate());
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                hasta=desde;
                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;
                $scope.fecha_inicial=$scope.fecha_desde;
                $scope.make_day($scope.fecha_inicial);
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
                desde+=(((primerdia.getMonth()+1)<10) ? "0"+(primerdia.getMonth()+1):(primerdia.getMonth()+1)).toString()+"-";
                desde+=((primerdia.getDate())<10) ? "0"+(primerdia.getDate()):(primerdia.getDate());
                $("#fecha_desde").val(desde);
                $scope.fecha_desde=desde;

                hasta=ultimodia.getFullYear()+"-";
                hasta+=(((ultimodia.getMonth()+1)<10) ? "0"+(ultimodia.getMonth()+1):(ultimodia.getMonth()+1)).toString()+"-";
                hasta+=((ultimodia.getDate())<10) ? "0"+(ultimodia.getDate()):(ultimodia.getDate());

                $("#fecha_hasta").val(hasta);
                $scope.fecha_hasta=hasta;
                
                $scope.fecha_inicial=$scope.fecha_desde;


                $scope.week($scope.fecha_desde,$scope.fecha_hasta);

            break;
        };  
    };

    $scope.control_panel=function (action,f) {

        $("#btn_mes").removeClass("active");
        $("#btn_dia").removeClass("active");
        $("#btn_year").removeClass("active");
        $("#btn_semana").removeClass("active");
        switch(action){
            case "M":
                $scope.tipo_calendar=action;
                $("#btn_mes").addClass("active");
                $scope.crear_fechas_control(action,f);
            break;
            case "D":
                $scope.tipo_calendar=action;
                $("#btn_dia").addClass("active");
                $scope.crear_fechas_control(action,f);
            break;
            case "Y":
                $scope.tipo_calendar=action;
                $("#btn_year").addClass("active");
                $scope.crear_fechas_control(action,f);
            break;
            case "S":
                $scope.tipo_calendar=action;
                $("#btn_semana").addClass("active");
                $scope.crear_fechas_control(action,f);
            break;
        };
    };
    //$scope.control_panel($scope.tipo_calendar, $scope.fecha_referencial_angular);
    $scope.control_panel2=function (action) {
        $scope.control_panel(action, $scope.fecha_referencial_angular);
    };

    $scope.control_panel3=function() {
      $scope.control_panel($scope.tipo_calendar, $scope.fecha_referencial_angular);  
    };
    
    ///---





    ///--- retroceder y adelantar calendario
    $scope.back_calendar=function(){

        var aux_mes= $scope.fecha_inicial;
        var aux = aux_mes.split("-");

        switch($scope.tipo_calendar){
            case "M": // mensual
                var fecha_back= new Date(parseInt(aux[0]), (parseInt(aux[1]) -1 ),1);
                fecha_back.setMonth(fecha_back.getMonth()-1); //restar mes
                $scope.crear_fechas_control($scope.tipo_calendar, fecha_back);
                
            break;
            case "S":
                var fecha_back= new Date(parseInt(aux[0]), (parseInt(aux[1]) -1 ),parseInt(aux[2]));
                fecha_back.setDate(fecha_back.getDate()-7); //restar dias
                $scope.crear_fechas_control($scope.tipo_calendar, fecha_back);
            break;
            case "D":
                var fecha_back= new Date(parseInt(aux[0]), (parseInt(aux[1]) -1 ),parseInt(aux[2]));
                fecha_back.setDate(fecha_back.getDate()-1); //restar dias
                $scope.crear_fechas_control($scope.tipo_calendar, fecha_back);
            break;
        };
        $scope.titulo_fecha();
    };

    $scope.nex_calendar=function(){
        var aux_mes= $scope.fecha_inicial;
        var aux = aux_mes.split("-");
        switch($scope.tipo_calendar){
            case "M": // mensual
                var fecha_next= new Date(parseInt(aux[0]), (parseInt(aux[1])-1),1);
                fecha_next.setMonth(fecha_next.getMonth() + 1); //sumar mes
                $scope.crear_fechas_control($scope.tipo_calendar, fecha_next);
            break;
            case "S":
                var fecha_back= new Date(parseInt(aux[0]), (parseInt(aux[1]) -1 ),parseInt(aux[2]));
                fecha_back.setDate(fecha_back.getDate()+7); //sumar dias
                $scope.crear_fechas_control($scope.tipo_calendar, fecha_back);
            break;
            case "D":
                var fecha_back= new Date(parseInt(aux[0]), (parseInt(aux[1]) -1 ),parseInt(aux[2]));
                fecha_back.setDate(fecha_back.getDate()+1); //sumar dias
                $scope.crear_fechas_control($scope.tipo_calendar, fecha_back);
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

    //$scope.calendar($scope.fecha_inicial);
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

            $scope.list_empleados0=[];
            $scope.all_empleado=function(){
                var filtros = {
                    buscar:'',
                    estado: '1'
                };
                $scope.list_empleados0=[];
                $http.get(API_URL + 'Empleado/get_list_empleado_excell/' + JSON.stringify(filtros))
                    .then(function(response){
                        $scope.list_empleados0 = response.data;
                        $scope.empleadoagenda=String($scope.user_agenda.id_emp);
                 });
            };
            $scope.all_empleado();



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



        
    ///--- end crear agenda 

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
        var fhoy=new Date();
        var today=fhoy.getFullYear()+"-"+(fhoy.getMonth()+1)+"-"+fhoy.getDate();
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

        $scope.aux_edit_cita={}; 

        $scope.control_panel2($scope.tipo_calendar);

    };
    ///--- guardar agenda

    ///---editar agenda
    $scope.aux_edit_cita={}; 
    $scope.edit_cita=function(item){
        $scope.aux_edit_cita=item;
        $scope.tipo_calendar='AG';

        $scope.aux_cliente=item.cliente;
        $scope.nombrecliente=item.cliente.persona.apellido+" "+item.cliente.persona.nombre;


        $scope.aux_empleado=item.empleado;
        $scope.nombreempleado=item.empleado.persona.apellido+" "+item.empleado.persona.nombre;


        $scope.tipoagenda=String(item.tipo);

        $scope.observacion=item.observacion;

        console.log(item);
    };

    $scope.save_edit_agenda=function(){
        $("#progress").modal("show");
        var fhoy=new Date();
        var today=fhoy.getFullYear()+"-"+(fhoy.getMonth()+1)+"-"+fhoy.getDate();
        var agenda={
            id_ag:$scope.aux_edit_cita.id_ag, 
            id_em: $scope.aux_edit_cita.id_em,
            id_u: $scope.aux_edit_cita.id_u,
            id_cli: $scope.aux_cliente.id_cli,
            id_emp: $scope.aux_empleado.id_emp,
            turno: $scope.aux_empleado.turno,
            fechacreacion: today,
            fecha: $scope.fechacita,
            horainicio: $scope.hora,
            horafin: '',
            observacion: $scope.observacion,
            tipo: $scope.tipoagenda, // 1 normal , 2 emergencia 
            gestion:$scope.aux_empleado.gestion, // 1, sin gestionar 2, gestionada o finalizada
            estado: $scope.aux_empleado.estado // 1 activa, 0 inactiva 
        };
        $http.put(API_URL + 'Agenda/'+$scope.aux_edit_cita.id_ag,agenda)
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
    ///---editar agenda 


    ///--- inforamcion de la citas 
    $scope.list_info_day=[];
    $scope.info_citas_dia=function(item){
        var filtro_cita={
            Fecha: item.Fecha,
            id_emp: $scope.empleadoagenda,
            estado: $scope.estadoanuladoagenda
        };
        $scope.list_info_day=[];
        $http.get(API_URL + 'Agenda/get_info_agenda_mensual/' + JSON.stringify(filtro_cita))
            .then(function(response){
                console.log(response.data);
                $scope.list_info_day=response.data;
                $('#citas').modal('show');
        });           

    };
    ///--- inforamcion de la citas 

    ///---dar de baja cita 
    $scope.aux_estado_agenda={};
    $scope.int_estado=function(item){
        $scope.aux_estado_agenda=item;
        if($scope.aux_estado_agenda.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar la cita";
        }else{
            $scope.Msm_estado=" Esta seguro de activar la cita";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_agenda.estado.toString()=="1")?"0":"1";

      var Rol={
        id_ag:$scope.aux_estado_agenda.id_ag,
        estado:aux_estado
      };
      $http.get(API_URL + 'Agenda/estado/' + JSON.stringify(Rol))
        .success(function(data){
            if(data.success==0){
                $("#progress").modal("hide");
                sms("btn-success","Se guardo correctamente la transacción..!!");
                //$scope.clear();
                //$scope.newusersin="0";
                $scope.control_panel3();
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar la transacción..!!");
                //$scope.clear();
                //$scope.newusersin="0";
                $scope.control_panel3();
            }
        });        
    };
    ///---dar de baja cita


    ///---Logica de citas medicas
    $scope.aux_anamnesis=[];
    $scope.datos_cita={};
    $scope.aux_diagnostico=[];
    $scope.ready_cita=function (item) {

        var f =new Date();
        var today=f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();

        $scope.aux_diagnostico=[];

        $scope.datos_cita={};
        $scope.tipo_calendar="CIT"; //ESTA DE  QUE INICIA LA CITA MEDICA
        $scope.datos_cita=item;
        console.log(item);


        var antecedents_familiares={
            id_antf:null, 
            id_cone:null, 
            cardiopatia:null, 
            diabetes:null, 
            vascular:null, 
            hipertencion:null, 
            cancer:null, 
            tuberculosis:null, 
            enfmental:null, 
            enfinfecciosa:null, 
            malformacion:null, 
            otro:null, 
            descripcion:null, 
            estado:null
        };
        var aux_antecedents_familiares=[];
        aux_antecedents_familiares.push(antecedents_familiares);

       /* var aux_cie={
            id_ci:null, 
            id_clasf:null, 
            orden:null, 
            imagen:null, 
            fechaingreso:null, 
            codigo:"asdasdsa", 
            descripcion:"prueba medicamento", 
            estado:null
        };
        var diagnostico={
            id_diag:null, 
            id_cone:null, 
            id_ci:null, 
            presuntivo:null, 
            definitivo:null,
            cie:aux_cie
        };
        
        $scope.aux_diagnostico.push(diagnostico);*/

        var fisico_regional={
            id_freg:null, 
            id_cone:null, 
            cabeza_cp:null, 
            cabeza_sp:null, 
            cuello_cp:null, 
            cuello_sp:null, 
            torax_cp:null, 
            torax_sp:null, 
            abdomen_cp:null, 
            abdomen_sp:null, 
            pelvis_cp:null, 
            pelvis_sp:null, 
            extremidades_cp:null, 
            extremidades_sp:null, 
            descripcion:null, 
            estado:null
        };
        var aux_fisico_regional=[];
        aux_fisico_regional.push(fisico_regional);

        var organos_sistemas={
            id_orgs:null,
            id_cone:null , 
            sentidos_cp:null , 
            sentidos_sp:null , 
            respiratorio_cp:null , 
            respiratorio_sp:null , 
            vascular_cp:null, 
            vascular_sp:null, 
            digestivo_cp:null, 
            digestivo_sp:null, 
            genital_cp:null, 
            genital_sp:null, 
            urinario_cp:null, 
            urinario_sp:null, 
            mesqueletico_cp:null, 
            mesqueletico_sp:null, 
            endocrino_cp:null, 
            endocrino_sp:null, 
            linfatico_cp:null, 
            linfatico_sp:null, 
            nervioso_cp:null, 
            nervioso_sp:null, 
            descripcion:null, 
            estado:null
        };
        var aux_organos_sistemas=[];
        aux_organos_sistemas.push(organos_sistemas);

        var signos_vitales={
            id_sigv:null, 
            id_cone:null, 
            fechamedicion:today, 
            temperatura:null, 
            presionarterial:null, 
            pulso:null, 
            frerespiratoria:null, 
            peso:null, 
            talla:null, 
            estado:null
        };
        var aux_signos_vitales=[];
        aux_signos_vitales.push(signos_vitales);
        var consulta_externa={
            id_cone:null, 
            id_ag:item.id_ag, 
            fecha:today, 
            motivo:null, 
            antecedentespersonales:null, 
            enfermedadactual:null, 
            planestratamiento:null, 
            data_json:null, 
            estado:null,
            antecedentesfamiliares: aux_antecedents_familiares,
            diagnostico: $scope.aux_diagnostico,
            fisicoregional:aux_fisico_regional,
            organossistemas:aux_organos_sistemas,
            signosvitales:aux_signos_vitales
        };

        $scope.aux_anamnesis.push(consulta_externa);


        $scope.get_anamnesis(item.id_ag);
    };

    $scope.clear_anamnesis=function()
    {
        var f =new Date();
        var today=f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();

        $scope.aux_anamnesis=[];
        $scope.aux_diagnostico=[];
        var antecedents_familiares={
            id_antf:null, 
            id_cone:null, 
            cardiopatia:null, 
            diabetes:null, 
            vascular:null, 
            hipertencion:null, 
            cancer:null, 
            tuberculosis:null, 
            enfmental:null, 
            enfinfecciosa:null, 
            malformacion:null, 
            otro:null, 
            descripcion:null, 
            estado:null
        };
        var aux_antecedents_familiares=[];
        aux_antecedents_familiares.push(antecedents_familiares);

        var fisico_regional={
            id_freg:null, 
            id_cone:null, 
            cabeza_cp:null, 
            cabeza_sp:null, 
            cuello_cp:null, 
            cuello_sp:null, 
            torax_cp:null, 
            torax_sp:null, 
            abdomen_cp:null, 
            abdomen_sp:null, 
            pelvis_cp:null, 
            pelvis_sp:null, 
            extremidades_cp:null, 
            extremidades_sp:null, 
            descripcion:null, 
            estado:null
        };
        var aux_fisico_regional=[];
        aux_fisico_regional.push(fisico_regional);

        var organos_sistemas={
            id_orgs:null,
            id_cone:null , 
            sentidos_cp:null , 
            sentidos_sp:null , 
            respiratorio_cp:null , 
            respiratorio_sp:null , 
            vascular_cp:null, 
            vascular_sp:null, 
            digestivo_cp:null, 
            digestivo_sp:null, 
            genital_cp:null, 
            genital_sp:null, 
            urinario_cp:null, 
            urinario_sp:null, 
            mesqueletico_cp:null, 
            mesqueletico_sp:null, 
            endocrino_cp:null, 
            endocrino_sp:null, 
            linfatico_cp:null, 
            linfatico_sp:null, 
            nervioso_cp:null, 
            nervioso_sp:null, 
            descripcion:null, 
            estado:null
        };
        var aux_organos_sistemas=[];
        aux_organos_sistemas.push(organos_sistemas);

        var signos_vitales={
            id_sigv:null, 
            id_cone:null, 
            fechamedicion:today, 
            temperatura:null, 
            presionarterial:null, 
            pulso:null, 
            frerespiratoria:null, 
            peso:null, 
            talla:null, 
            estado:null
        };
        var aux_signos_vitales=[];
        aux_signos_vitales.push(signos_vitales);
        var consulta_externa={
            id_cone:null, 
            id_ag:null, 
            fecha:today, 
            motivo:null, 
            antecedentespersonales:null, 
            enfermedadactual:null, 
            planestratamiento:null, 
            data_json:null, 
            estado:null,
            antecedentesfamiliares: aux_antecedents_familiares,
            diagnostico: $scope.aux_diagnostico,
            fisicoregional:aux_fisico_regional,
            organossistemas:aux_organos_sistemas,
            signosvitales:aux_signos_vitales
        };

        $scope.aux_anamnesis.push(consulta_externa);
    };

    $scope.save_anamnesis=function() {
        $("#progress").modal("show");
      console.log($scope.aux_anamnesis);

      $http.post(API_URL + 'Anamnesis',$scope.aux_anamnesis)
        .success(function(response){
            console.log(response);
            $("#progress").modal("hide");
            if(response.success==0){
                sms("btn-success","Se guardo correctamente los datos..!!");
                $scope.clear_agenda();
                $scope.clear_anamnesis();

                $scope.tipo_calendar="DIAG";/// Recetar 
            }else{
                sms("btn-danger","Error al guardar los datos..!!");
                $scope.clear_agenda();
                $scope.clear_anamnesis();
            }
        });

    };
    $scope.save_edit_anamnesis=function() {
        $("#progress").modal("show");
      console.log($scope.aux_anamnesis);

      //$http.post(API_URL + 'Anamnesis',$scope.aux_anamnesis)
      $http.put(API_URL + 'Anamnesis/'+$scope.aux_anamnesis[0].id_cone,$scope.aux_anamnesis)
        .success(function(response){
            console.log(response);
            $("#progress").modal("hide");
            if(response.success==0){
                sms("btn-success","Se guardo correctamente los datos..!!");
                $scope.clear_agenda();
                $scope.clear_anamnesis();

                $scope.tipo_calendar="DIAG";/// Recetar 
            }else{
                sms("btn-danger","Error al guardar los datos..!!");
                $scope.clear_agenda();
                $scope.clear_anamnesis();
            }
        });
    };
    

    $scope.find_cie=function () {
        $("#cie_information").modal("show");
        $scope.pageChanged_cie(1);
    };


    $scope.lis_cie10=[];
    $scope.buscar_cie10="";
    $scope.pageChanged_cie = function(newPage) {
        $scope.buscar_cie(newPage);
    };
    $scope.buscar_cie = function(pageNumber){

        var filtros = {
            buscar:$scope.buscar_cie10,
            estado: '1'
        };
        $http.get(API_URL + 'Cie/get_list_cie?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.lis_cie10 = response.data.data;
                $scope.totalItemscie = response.data.total;
            });
    };
    $scope.select_cie10=function(u) {
        var diagnostico={
            id_diag:null, 
            id_cone:null, 
            id_ci:null, 
            presuntivo:null, 
            definitivo:null,
            cie:u
        };
        $scope.aux_diagnostico.push(diagnostico);
        $("#cie_information").modal("hide");
    };

    $scope.delete_cie=function (item) {
        var posicion= $scope.aux_diagnostico.indexOf(item);
         $scope.aux_diagnostico.splice(posicion,1);
    };

    
    $scope.get_anamnesis=function(id){
        var filtro_cita={
            Fecha: '',
            id_emp: '',
            estado: '',
            id_ag:id
        };

        $http.get(API_URL + 'Anamnesis/get_anamnesis_id/' + JSON.stringify(filtro_cita))
            .then(function(response){
                console.log(response.data);
                if(response.data[0].id_ag!=null && response.data[0].id_ag!=undefined  ){
                    $scope.aux_anamnesis=response.data;
                    $scope.aux_diagnostico=$scope.aux_anamnesis[0].diagnostico;
                }
                //$scope.aux_anamnesis=response.data;
            });

    };

    $scope.ready_receta=function (item) {
        if(item.consultageneral.length>0){// tiene consulta externa
            console.log(item.consultageneral);
            $scope.tipo_calendar="DIAG";/// Recetar 

        }else{
            sms("btn-info","Ingrese la Anamnesis ");
        }
    };

    $scope.add_vademecum=function() {
        
    };

    $scope.calcular_edad=function(fecha) {
        if(fecha==undefined  || fecha==null) return "";

        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }

        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;

        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        return edad+" años, "+meses+" meses y "+dias+" días";
    }
    ///---Logica de citas medicas
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
