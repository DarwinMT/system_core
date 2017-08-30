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

        $scope.aux_provider={};

        $("#fechan").val("");

        $scope.initLoad(1);

        $scope.aux_estado_provider={};
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
    $scope.valida_user_dni_edit=function(){
        var usuario={
            id: $scope.aux_provider.persona.id_pe,
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
    $scope.valida_dni=function(){
        if($scope.aux_provider.persona.id_pe!=null || $scope.aux_provider.persona.id_pe!=undefined){
            $scope.valida_user_dni_edit();
        }else{
            $scope.valida_user_dni();
        }
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

    ///---
    $scope.aux_provider={};
    $scope.init_edit=function(item){

        $scope.aux_provider=item;

        console.log($scope.aux_provider);

        $scope.newedit="2";

        $scope.ci= $scope.aux_provider.persona.ci; 
        $scope.nombre= $scope.aux_provider.persona.nombre;
        $scope.apellido= $scope.aux_provider.persona.apellido;
        $scope.avatar= ''; 
        $scope.genero= $scope.aux_provider.persona.genero;
        $("#fechan").val($scope.aux_provider.persona.fechan);
        $scope.direccion= $scope.aux_provider.persona.direccion; 
        $scope.email= $scope.aux_provider.persona.email; 

        $scope.razonsocial=$scope.aux_provider.razonsocial;
        $scope.telefonoprincipal=$scope.aux_provider.telefonoprincipal;

        $scope.file= '';
        $scope.url=$scope.aux_provider.persona.avatar;
    };
        $scope.edit=function(){
        
        
        var data_persona={
            id_pe: $scope.aux_provider.persona.id_pe,
            ci:$scope.ci, 
            nombre:$scope.nombre, 
            apellido:$scope.apellido, 
            avatar: $scope.aux_provider.persona.avatar, 
            genero:$scope.genero, 
            fechan:$("#fechan").val(), 
            direccion:$scope.direccion, 
            email:$scope.email,
            estado:$scope.aux_provider.persona.estado
        };

        var data_proveedor={
            id_prov: $scope.aux_provider.id_prov,
            id_pe: $scope.aux_provider.persona.id_pe,
            fechaingreso:$scope.aux_provider.persona.fechaingreso,
            telefonoprincipal:$scope.telefonoprincipal,
            razonsocial: $scope.razonsocial,
            estado:'1'
        };

        var data_provider={
            Persona: data_persona,
            Proveedor: data_proveedor,
            file: $scope.file_edit
        };
        $("#progress").modal("show");
        
        Upload.upload({
            url: API_URL + "Proveedor/update_proveedor/" + $scope.aux_provider.persona.id_pe,
            method: 'POST',
            data: data_provider
        }).success(function(data, status, headers, config) {
           if(data.success==0){
                $("#progress").modal("hide");
                sms("btn-success","Se guardo correctamente la transacción..!!");
                $scope.clear();
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar la transacción..!!");
                $scope.clear();
            }
        });

    };
    ///---


        ///---
    $scope.Msm_estado="";
    $scope.aux_estado_provider={};
    $scope.int_estado=function(item){
        $scope.aux_estado_provider=item;
        if($scope.aux_estado_provider.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar el proveedor";
        }else{
            $scope.Msm_estado=" Esta seguro de activar el proveedor";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_provider.estado.toString()=="1")?"0":"1";

      var Proveedor={
        id_prov:$scope.aux_estado_provider.id_prov,
        estado:aux_estado
      };
      $http.get(API_URL + 'Proveedor/estado/' + JSON.stringify(Proveedor))
        .success(function(data){
            if(data.success==0){
                $("#progress").modal("hide");
                sms("btn-success","Se guardo correctamente la transacción..!!");
                $scope.clear();
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar la transacción..!!");
                $scope.clear();
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