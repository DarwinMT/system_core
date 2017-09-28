app.controller('LogicaAgenda', function($scope, $http, API_URL,Upload) {
    $scope.Title="Agendar Citas";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });


    ///--- crear calendario 
    $scope.mes=[];
    $scope.calendar=function(){
        var feha=new Date();

        var fecha_inicial = new Date(feha.getFullYear(), feha.getMonth(), 1);
        var fecha_final = new Date(feha.getFullYear(), feha.getMonth() + 1, 0);

        var numero_dias=((fecha_final-fecha_inicial)/(1000*60*60*24));

        /*
        console.log(fecha_inicial);
        console.log(fecha_final);

        console.log(fecha_inicial.getFullYear() +"-"+ fecha_inicial.getMonth()+"-"+ fecha_inicial.getDate());
        console.log(fecha_final.getFullYear() +"-"+ fecha_final.getMonth()+"-"+ fecha_final.getDate());
        console.log(numero_dias);
        console.log(fecha_inicial.getDay());*/

        var aux_d=0;
        var primer_dia=1;
        var dias=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
        for(var x=1; x<=fecha_final.getDate();x++){


            if(aux_d<=6){
                var aux_fecha= new Date(fecha_final.getFullYear(), fecha_final.getMonth(), x);
                if(aux_fecha.getDay()==0 && primer_dia==1){

                }else{
                    
                }
                console.log(aux_fecha.getFullYear()+"-"+aux_fecha.getMonth()+"-"+aux_fecha.getDate() +" /// "+dias[aux_fecha.getDay()]);
                //console.log(aux_fecha.getDay());
                

            }else{
                aux_d=0;
                primer_dia=1;
            }
            aux_d++;
            primer_dia++;
        }

        /*var cita=[];


        var cita1={
            Id:1,
            Descripcion:' Texto 1',
            Hora: '12:30'
        };
        var cita2={
            Id:1,
            Descripcion:' Texto 1',
            Hora: '1:00'
        };
        cita.push(cita1);
        cita.push(cita2);

        var dia0={ // sabado
            Dia:1,
            Citas: cita
        };

        var dia1={ // domingo
            Dia:1,
            Citas: cita
        };

        var dia2={ // lunes
            Dia:1,
            Citas: cita
        };

        var dia3={ // martes
            Dia:1,
            Citas: cita
        };

        var dia4={ // miercoles
            Dia:1,
            Citas: cita
        };

        var dia5={ // jueves
            Dia:1,
            Citas: cita
        };

        var dia6={ // viernes
            Dia:1,
            Citas: cita
        };


        var aux_dias=[];
        aux_dias.push(dia0);
        aux_dias.push(dia1);
        aux_dias.push(dia2);
        aux_dias.push(dia3);
        aux_dias.push(dia4);
        aux_dias.push(dia5);
        aux_dias.push(dia6);


        var semana={
            Dias: aux_dias
        };

        var semana1={
            Dias: aux_dias
        };
        var semana2={
            Dias: aux_dias
        };
        var semana3={
            Dias: aux_dias
        };


        $scope.mes.push(semana);
        $scope.mes.push(semana1);
        $scope.mes.push(semana2);
        $scope.mes.push(semana3);

        console.log($scope.mes);*/

    };
    $scope.calendar();


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