app.controller('LogicaCliente', function($scope, $http, API_URL,Upload) {
    $scope.Title="Clientes";
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
        $http.get(API_URL + 'Cliente')
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

    $scope.direcciontrabajo="";
    $scope.telefonotrabajo="";
    $scope.telefonodomicilio="";

    

   
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
        var data_cliente={
            id_pe:'',
            numerohistoria:'',
            fecharegistro:today,
            direcciontrabajo: $scope.direcciontrabajo,
            telefonotrabajo:$scope.telefonotrabajo,
            telefonodomicilio: $scope.telefonodomicilio,
            estado:'1'
        };

        var DataCliente={
            Persona:data_persona,
            Cliente:data_cliente,
            file: $scope.file
        };
        $("#progress").modal("show");
        

        Upload.upload({
            url: API_URL + 'Cliente',
            method: 'POST',
            data: DataCliente
        }).success(function(data, status, headers, config) {
            console.log(data.success)
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
        $scope.telefonotrabajo="";

        $scope.direcciontrabajo="";
        $scope.telefonodomicilio="";

        $scope.newedit="0";

        $scope.aux_client={};

        $("#fechan").val("");

        $scope.initLoad(1);

        $scope.aux_estado_client={};
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
            id: $scope.aux_client.persona.id_pe,
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
        if($scope.aux_client.persona!=null || $scope.aux_client.persona!=undefined){
            if($scope.aux_client.persona.id_pe!=null || $scope.aux_client.persona.id_pe!=undefined){
                $scope.valida_user_dni_edit();
            }else{
                $scope.valida_user_dni();
            }
        }else{
            $scope.valida_user_dni();
        }
    };
    ///---


    ///---
    $scope.buscartexto="";
    $scope.estadoanulado="1";
    $scope.list_cliente=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'Cliente/get_list_cliente?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_cliente = response.data.data;
                $scope.totalItems = response.data.total;
                console.log($scope.list_cliente);
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.aux_client={};
    $scope.init_edit=function(item){

        $scope.aux_client=item;

        console.log($scope.aux_client);

        $scope.newedit="2";

        $scope.ci= $scope.aux_client.persona.ci; 
        $scope.nombre= $scope.aux_client.persona.nombre;
        $scope.apellido= $scope.aux_client.persona.apellido;
        $scope.avatar= ''; 
        $scope.genero= $scope.aux_client.persona.genero;
        $("#fechan").val($scope.aux_client.persona.fechan);
        $scope.direccion= $scope.aux_client.persona.direccion; 
        $scope.email= $scope.aux_client.persona.email; 

        $scope.direcciontrabajo=$scope.aux_client.direcciontrabajo;
        $scope.telefonotrabajo=$scope.aux_client.telefonotrabajo;
        $scope.telefonodomicilio=$scope.aux_client.telefonodomicilio;

        $scope.file= '';
        $scope.url_foto=$scope.aux_client.persona.avatar;
    };
        $scope.edit=function(){
        
        
        var data_persona={
            id_pe: $scope.aux_client.persona.id_pe,
            ci:$scope.ci, 
            nombre:$scope.nombre, 
            apellido:$scope.apellido, 
            avatar: $scope.aux_client.persona.avatar, 
            genero:$scope.genero, 
            fechan:$("#fechan").val(), 
            direccion:$scope.direccion, 
            email:$scope.email,
            estado:$scope.aux_client.persona.estado
        };

        var data_cliente={
            id_cli: $scope.aux_client.id_cli,
            id_pe: $scope.aux_client.persona.id_pe,
            numerohistoria:$scope.aux_client.numerohistoria,
            fecharegistro:$scope.aux_client.persona.fecharegistro,
            direcciontrabajo: $scope.direcciontrabajo,
            telefonotrabajo:$scope.telefonotrabajo,
            telefonodomicilio:$scope.telefonodomicilio,
            estado:'1'
        };

        var data_client={
            Persona: data_persona,
            Cliente: data_cliente,
            file: $scope.file
        };
        $("#progress").modal("show");
        
        Upload.upload({
            url: API_URL + "Cliente/update_cliente/" + $scope.aux_client.persona.id_pe,
            method: 'POST',
            data: data_client
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
    $scope.aux_estado_client={};
    $scope.int_estado=function(item){
        $scope.aux_estado_client=item;
        if($scope.aux_estado_client.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar el cliente";
        }else{
            $scope.Msm_estado=" Esta seguro de activar el cliente";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_client.estado.toString()=="1")?"0":"1";

      var Cliente={
        id_cli:$scope.aux_estado_client.id_cli,
        estado:aux_estado
      };
      $http.get(API_URL + 'Cliente/estado/' + JSON.stringify(Cliente))
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

    ///---
    $scope.list_client_excell=[];
    $scope.excell_cliente=function(){
        $("#progress").modal("show");
        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $scope.list_client_excell=[];
        $http.get(API_URL + 'Cliente/get_list_client_excell/' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_client_excell = response.data;
                console.log($scope.list_client_excell);

                setTimeout(function(){
                    $("#list_excell").table2excel({
                        exclude: ".noExl",
                        name: "Lista De Clientes",
                        filename: "Lista De Clientes" 
                    });
                    $("#progress").modal("hide");
                },1000);
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