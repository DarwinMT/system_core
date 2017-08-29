app.controller('LogicaProveedor', function($scope, $http, API_URL,Upload) {
    $scope.Title="Proveedores";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.newedit="0";
    $scope.valida_dninew=0;

    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Proveedor')
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
    $scope.ci=""; 
    $scope.nombre=""; 
    $scope.apellido=""; 
    $scope.avatar=""; 
    $scope.file="";
    $scope.genero="";
    $scope.fechan="";
    $scope.direccion=""; 
    $scope.email="";
    $scope.telefonoprincipal="";

    $scope.razonsocial="";

   
       $scope.save=function() {
        var data_persona={
            ci:$scope.ci, 
            nombre:$scope.nombre, 
            apellido:$scope.apellido, 
            avatar:'', 
            genero:$scope.genero, 
            fechan:$("#fechan").val(), 
            direccion:$scope.direccion, 
            email:$scope.email
        };
        var f =new Date();
        var today=f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
        var data_proveedor={
            id_pe:'',
            fechaingreso:today,
            telefonoprincipal:$scope.telefonoprincipal,
            razonsocial: $scope.razonsocial,
            estado:'1'
        };

        var DataProveedor={
            Persona:data_persona,
            Proveedor:data_proveedor,
            file: $scope.file
        };
        $("#progress").modal("show");
        

        Upload.upload({
            url: API_URL + 'Proveedor',
            method: 'POST',
            data: DataProveedor
        }).success(function(data, status, headers, config) {
           if(data.success==0){
                $("#progress").modal("hide");
                sms("btn-success","Se guardo correctamente la transacción..!!");
                $scope.clear();
                $scope.newedit="0";
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar la transacción..!!");
                $scope.clear();
                $scope.newedit="0";
            }
        });

    };
    ///---

    ///---
    $scope.clear=function(){
        $scope.ci=""; 
        $scope.nombre=""; 
        $scope.apellido=""; 
        $scope.avatar=""; 
        $scope.file="";
        $scope.genero="";
        $scope.fechan="";
        $scope.direccion=""; 
        $scope.email="";
        $scope.telefonoprincipal="";

        $scope.razonsocial="";

        $scope.newedit="0";
    };
    ///---

    ///---
    $scope.valida_dninew=0;
    $scope.valida_user_dni=function(){
        var usuario={
            id: '',
            ci:$scope.ci.trim()
        };
        $http.get(API_URL + 'User/valida_dni/'+JSON.stringify(usuario))
        .success(function(response){
            $scope.valida_dninew=parseInt(response);
            $("#vista_dni_new").removeClass("has-success");
            $("#vista_dni_new").removeClass("has-error");
            if(parseInt($scope.valida_dninew)==0){
                $("#vista_dni_new").addClass("has-success");
            }else{
                $("#vista_dni_new").addClass("has-error");
            }
        });  
    };
    ///---


    ///---
    $scope.buscartexto="";
    $scope.estadoanulado="1";
    $scope.list_proveedor=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'Proveedor/get_list_proveedor?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_proveedor = response.data.data;
                $scope.totalItems = response.data.total;
                console.log($scope.list_proveedor);
         });
    };
    $scope.initLoad(1);
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