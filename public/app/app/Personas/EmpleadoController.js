app.controller('LogicaEmpleado', function($scope, $http, API_URL,Upload) {
    $scope.Title="Empleados";
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
        $http.get(API_URL + 'Empleado')
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
        var data_empleado={
            id_pe:'',
            fechaingreso:today,
            estado:'1'
        };

        var DataEmpleado={
            Persona:data_persona,
            Empleado:data_empleado,
            file: $scope.file
        };
        $("#progress").modal("show");
        

        Upload.upload({
            url: API_URL + 'Empleado',
            method: 'POST',
            data: DataEmpleado
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
        

        $scope.newedit="0";

        $scope.aux_empleado={};

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
            id: $scope.aux_empleado.persona.id_pe,
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
        if($scope.aux_empleado.persona!=null || $scope.aux_empleado.persona!=undefined){
            if($scope.aux_empleado.persona.id_pe!=null || $scope.aux_empleado.persona.id_pe!=undefined){
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
    $scope.list_empleados=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'Empleado/get_list_empleado?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_empleados = response.data.data;
                $scope.totalItems = response.data.total;
                console.log($scope.list_empleados);
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.aux_empleado={};
    $scope.init_edit=function(item){

        $scope.aux_empleado=item;

        console.log($scope.aux_empleado);

        $scope.newedit="2";

        $scope.ci= $scope.aux_empleado.persona.ci; 
        $scope.nombre= $scope.aux_empleado.persona.nombre;
        $scope.apellido= $scope.aux_empleado.persona.apellido;
        $scope.avatar= ''; 
        $scope.genero= $scope.aux_empleado.persona.genero;
        $("#fechan").val($scope.aux_empleado.persona.fechan);
        $scope.direccion= $scope.aux_empleado.persona.direccion; 
        $scope.email= $scope.aux_empleado.persona.email; 

        $scope.razonsocial=$scope.aux_empleado.razonsocial;
        $scope.telefonoprincipal=$scope.aux_empleado.telefonoprincipal;

        $scope.file= '';
        $scope.url_foto=$scope.aux_empleado.persona.avatar;
    };
        $scope.edit=function(){
        
        
        var data_persona={
            id_pe: $scope.aux_empleado.persona.id_pe,
            ci:$scope.ci, 
            nombre:$scope.nombre, 
            apellido:$scope.apellido, 
            avatar: $scope.aux_empleado.persona.avatar, 
            genero:$scope.genero, 
            fechan:$("#fechan").val(), 
            direccion:$scope.direccion, 
            email:$scope.email,
            estado:$scope.aux_empleado.persona.estado
        };

        var data_pempleado={
            id_emp: $scope.aux_empleado.id_emp,
            id_pe: $scope.aux_empleado.persona.id_pe,
            fechaingreso:$scope.aux_empleado.persona.fechaingreso,
            telefonoprincipal:$scope.telefonoprincipal,
            razonsocial: $scope.razonsocial,
            estado:'1'
        };

        var data_empleado={
            Persona: data_persona,
            Empleado: data_pempleado,
            file: $scope.file
        };
        $("#progress").modal("show");
        
        Upload.upload({
            url: API_URL + "Empleado/update_empleado/" + $scope.aux_empleado.persona.id_pe,
            method: 'POST',
            data: data_empleado
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
    $scope.aux_estado_empleado={};
    $scope.int_estado=function(item){
        $scope.aux_estado_empleado=item;
        if($scope.aux_estado_empleado.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar el empleado";
        }else{
            $scope.Msm_estado=" Esta seguro de activar el empleado";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_empleado.estado.toString()=="1")?"0":"1";

      var Empleado={
        id_emp:$scope.aux_estado_empleado.id_emp,
        estado:aux_estado
      };
      $http.get(API_URL + 'Empleado/estado/' + JSON.stringify(Empleado))
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
    $scope.list_empleado_excell=[];
    $scope.excell_empleado=function(){
        $("#progress").modal("show");
        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $scope.list_empleado_excell=[];
        $http.get(API_URL + 'Empleado/get_list_empleado_excell/' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_empleado_excell = response.data;
                console.log($scope.list_empleado_excell);

                setTimeout(function(){
                    $("#list_excell").table2excel({
                        exclude: ".noExl",
                        name: "Lista De Empleado",
                        filename: "Lista De Empleado" 
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