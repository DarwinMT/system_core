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