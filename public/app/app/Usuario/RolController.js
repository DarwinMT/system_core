app.controller('LogicaRol', function($scope, $http, API_URL,Upload) {
    $scope.Title="Roles De Usuario";

    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.neweditrol="0";
    $scope.estadoanulado="1";
    
    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Roles')
        .success(function(response){
            console.log(response[0].id_men);
            if(response[0].id_men!= undefined  ){ // no tiene session activa
                $scope.list_permisos=response[0];
            }else{
                location.reload();
            }
        });
    };
    ///---


    ///---
    $scope.buscartexto="";
    $scope.estadoanulado="1";
    $scope.list_roles=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'Roles/get_list_roles?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_roles = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.list_roles_excell=[];
    $scope.excell_rol=function(){
        $("#progress").modal("show");
        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $scope.list_roles_excell=[];
        $http.get(API_URL + 'Roles/get_list_roles_excell/' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_roles_excell = response.data;
                console.log($scope.list_roles_excell);

                setTimeout(function(){
                    $("#list_rol").table2excel({
                        exclude: ".noExl",
                        name: "Lista De Roles",
                        filename: "Lista De Roles" 
                    });
                    $("#progress").modal("hide");
                },1000);
         });

    };
    ///---

    ///---
    $scope.clear=function(){
        $scope.neweditrol="0";
        $scope.descripcion="";

        $scope.initLoad(1);
    };
    ///---

    ///---
    $scope.save=function() {
        $("#progress").modal("show");
        var rol_data={
            descripcion: $scope.descripcion.trim(),
            estado: '1'
        };
        $http.post(API_URL + 'Roles',rol_data)
        .success(function(response){
            console.log(response);
            $("#progress").modal("hide");
                if(response.success==0){
                    sms("btn-success","Se guardo correctamente los datos..!!");
                    $scope.clear();
                }else{
                    sms("btn-danger","Error al guardar los datos..!!");
                    $scope.clear();
                }
        });
    };
    ///---

    ///---
    $scope.aux_rol={};
    $scope.init_edit=function(item){
        $scope.aux_rol=item;
        $scope.neweditrol="2";
        $scope.descripcion=$scope.aux_rol.descripcion;
    };
    $scope.edit=function(){
        $scope.aux_rol.descripcion=$scope.descripcion;
        $http.put(API_URL + 'Roles/'+$scope.aux_rol.id_r,$scope.aux_rol)
        .success(function(response){
            console.log(response);
            $("#progress").modal("hide");
                if(response.success==0){
                    sms("btn-success","Se guardo correctamente los datos..!!");
                    $scope.clear();
                }else{
                    sms("btn-danger","Error al guardar los datos..!!");
                    $scope.clear();
                }
        });
    };
    ///---

    ///---
    $scope.aux_estado_rol={};
    $scope.int_estado=function(item){
        $scope.aux_estado_rol=item;
        if($scope.aux_estado_rol.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar el rol";
        }else{
            $scope.Msm_estado=" Esta seguro de activar el rol";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_rol.estado.toString()=="1")?"0":"1";

      var Rol={
        id_r:$scope.aux_estado_rol.id_r,
        estado:aux_estado
      };
      $http.get(API_URL + 'Roles/estado/' + JSON.stringify(Rol))
        .success(function(data){
            if(data.success==0){
                $("#progress").modal("hide");
                sms("btn-success","Se guardo correctamente la transacción..!!");
                $scope.clear();
                $scope.newusersin="0";
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar la transacción..!!");
                $scope.clear();
                $scope.newusersin="0";
            }
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
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });
});