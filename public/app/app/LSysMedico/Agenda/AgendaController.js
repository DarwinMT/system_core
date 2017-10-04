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
        var aux_semanas=1;
        var dias=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];

        var semana1=[];
        var semana2=[];
        var semana3=[];
        var semana4=[];
        var semana5=[];
        for(var x=1; x<=fecha_final.getDate();x++){


            if(aux_d<=6){
                                
                var aux_fecha= new Date(fecha_final.getFullYear(), fecha_final.getMonth(), x);

                switch(aux_semanas){
                    case 1:
                        if(aux_fecha.getDay()!=0 && x==1){ //diferente de domingo 
                            for(var i=0;i<aux_fecha.getDay();i++){
                                var dia={
                                    Id:'',
                                    Numero_dia:'',
                                    Numero_Citas:''
                                };
                                semana1.push(dia);
                            }
                            var dia={
                                    Id:'',
                                    Numero_dia:x,
                                    Numero_Citas:'8'
                                };
                            semana1.push(dia);
                        }else{
                            if(semana1.length<=6){
                                var dia={
                                    Id:'',
                                    Numero_dia:x,
                                    Numero_Citas:'8'
                                };
                                semana1.push(dia);
                            }
                        }

                    break;

                    case 2:
                            var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'12'
                            };
                            semana2.push(dia);
                    
                    break;
                    case 3:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'5'
                            };
                        semana3.push(dia);
                        
                    break;
                    case 4:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'741'
                            };
                        semana4.push(dia);                        
                    break;
                    case 5:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'798'
                            };
                        semana5.push(dia);                        
                    break;
                }

            }else{

                aux_semanas++;
                switch(aux_semanas){
                    case 2:
                            var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'13'
                            };
                            semana2.push(dia)
                    break;
                    case 3:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'1'
                            };
                        semana3.push(dia);
                    break;
                    
                    case 4:
                        var dia={
                            Id:'',
                            Numero_dia:x,
                            Numero_Citas:'1222'
                        };
                        semana4.push(dia);
                    break;

                    case 5:
                        var dia={
                                Id:'',
                                Numero_dia:x,
                                Numero_Citas:'-551'
                            };
                        semana5.push(dia);
                    break;
                }

                aux_d=0;
                


            }
            aux_d++;
        }
        console.log(semana1);

        $scope.mes.push(semana1);
        $scope.mes.push(semana2);
        $scope.mes.push(semana3);
        $scope.mes.push(semana4);
        $scope.mes.push(semana5);
        console.log($scope.mes)


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