app.controller('LogicaAgendaCitasPersona', function($scope, $http, API_URL,Upload) {
    $scope.Title="Agendar";

      $(document).ready(function() {
        $('select').material_select();
        $('.tooltipped').tooltip({delay: 50});
        $('.modal').modal();
      });
      
    $scope.tipoagenda="1";
    $("#fechacita").val("");
    $scope.fechacita="";
    $scope.observacion="";
    $scope.hora="";

    $scope.nombrecliente="";
    $scope.aux_cliente=null; 

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


///--- datos de usuario para la agenda
    $scope.user_agenda={};
    $scope.aux_empleado={};
    $scope.get_user_agenda=function () {
        $http.get(API_URL + 'Agenda/get_user_agenda')
            .success(function(response){
                console.log(response);
                $scope.user_agenda=response[0];
                $scope.select_empleado($scope.user_agenda);
                $scope.Title="Agenda De Citas De "+$scope.user_agenda.persona.apellido+" "+$scope.user_agenda.persona.nombre;
            });
    };
    $scope.get_user_agenda();
     $scope.select_empleado=function(item){
        $scope.aux_empleado=null;
        $scope.aux_empleado=item;
        console.log($scope.aux_empleado)
    };
///--- datos de usuario para la agenda

    ///--- modal cliente
    $scope.buscar_cliente=function(){
        $("#md_cliente").modal("open");
        $scope.pageChanged_cliente(1);
    };
    ///--- modal cliente

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
    ///--- seleccione cliente
    $scope.select_cliente=function(item){
        $scope.nombrecliente="";
        $scope.aux_cliente=null; 
        $scope.aux_cliente=item;
        $scope.nombrecliente=item.persona.apellido+" "+item.persona.nombre;
        $("#md_cliente").modal("close");
    };    
    ///--- seleccione cliente
    //quitar cliente seleccionado
    $scope.limpiar_cliente=function() {
        $scope.nombrecliente="";
        $scope.aux_cliente=null;
    };
    //quitar cliente seleccionado
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
$('.tooltipped').tooltip({delay: 50});
$('.modal').modal();
});
