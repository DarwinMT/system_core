app.controller('LogicaListaCitasPersona', function($scope, $http, API_URL,Upload) {
    $scope.Title="Citas";
    
     var f = new Date();
    var dia=f.getDate();
    dia =(dia>10)?dia:"0"+dia;
    var mes=(f.getMonth()+1);
    mes=(mes>10)?mes:"0"+mes;
    var fecha=f.getFullYear()+"-"+mes+"-"+dia;

    $(document).ready(function(){
        $("#fecha_desde").val(fecha);
        $("#fecha_hasta").val(fecha);
    });

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
    $scope.permisos_user();
    ///---

    $scope.empleadoagenda="";
    ///---
    $scope.user_agenda={};
    $scope.get_user_agenda=function () {
        $http.get(API_URL + 'Agenda/get_user_agenda')
            .success(function(response){
                $scope.user_agenda=response[0];
                $scope.empleadoagenda=String($scope.user_agenda.id_emp);
                $scope.Title="Citas De "+$scope.user_agenda.persona.apellido+" "+$scope.user_agenda.persona.nombre;
                $scope.getcitas();
            });
    };
    $scope.get_user_agenda();
    ///---
    ///---
    $scope.list_agenda=[];
    $scope.getcitas=function(){
        var filtro_cita={
            Fechai: $("#fecha_desde").val(),
            Fechaf: $("#fecha_hasta").val(),
            id_emp: $scope.empleadoagenda,
            estado: '1'
        };
        $scope.list_agenda=[]; 
        $http.get(API_URL + 'Agenda/get_info_agenda_fechas_empleado/' + JSON.stringify(filtro_cita))
            .then(function(response){
                $scope.list_agenda=response.data;
        });
    };
    ///---

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

});
