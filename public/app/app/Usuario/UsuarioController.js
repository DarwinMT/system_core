app.controller('LogicaUsuario', function($scope, $http, API_URL,Upload) {
    $scope.Title="Usuario";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.newusersin="0";

    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'User')
        .success(function(response){
            console.log(response);
            $scope.list_permisos=response[0];
        });
    };

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

    $scope.username="";
    $scope.password="";

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

        var data_user={
            id_pe:'',
            username:$scope.username,
            password:$scope.password
        };

        var Usuario={
            Persona:data_persona,
            User:data_user,
            file: $scope.file
        };
        $("#progress").modal("show");
        
        /*$http.post(API_URL + 'User',Usuario)
        .success(function(response){
            if(response.success==0){
                $("#progress").modal("hide");
                sms("btn-success","Se guardo correctamente los datos..!!");
                $scope.clear();
                $scope.newusersin="0";
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar los datos..!!");
                $scope.clear();
                $scope.newusersin="0";
            }
        });*/

        Upload.upload({
            url: API_URL + 'User',
            method: 'POST',
            data: Usuario
        }).success(function(data, status, headers, config) {
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
    $scope.buscartexto="";
    $scope.estadoanulado="1";
    $scope.list_usuario=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'User/get_list_usuario?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_usuario = response.data.data;
                $scope.totalItems = response.data.total;
                console.log($scope.list_usuario);
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.aux_edit_user_data={};

    $scope.ci_edit=""; 
    $scope.nombre_edit=""; 
    $scope.apellido_edit=""; 
    $scope.avatar_edit=""; 
    $scope.genero_edit="";
    $scope.fechan_edit="";
    $scope.direccion_edit=""; 
    $scope.email_edit="";
    $scope.url_foto="";

        $scope.file_edit="";

    $scope.init_edit=function(item){
        console.log(item);
        $scope.aux_edit_user_data=item;
        $scope.newusersin="2";

        $scope.ci_edit= $scope.aux_edit_user_data.persona.ci; 
        $scope.nombre_edit= $scope.aux_edit_user_data.persona.nombre;
        $scope.apellido_edit= $scope.aux_edit_user_data.persona.apellido;
        $scope.avatar_edit= ''; 
        $scope.genero_edit= $scope.aux_edit_user_data.persona.genero;
        $("#fechan_edit").val($scope.aux_edit_user_data.persona.fechan);
        $scope.direccion_edit= $scope.aux_edit_user_data.persona.direccion; 
        $scope.email_edit= $scope.aux_edit_user_data.persona.email; 

        $scope.file_edit= '';
        $scope.url_foto=$scope.aux_edit_user_data.persona.avatar;

    };
    $scope.edit=function(){
        
        
        var data_persona={
            id_pe: $scope.aux_edit_user_data.persona.id_pe,
            ci:$scope.ci_edit, 
            nombre:$scope.nombre_edit, 
            apellido:$scope.apellido_edit, 
            avatar: $scope.aux_edit_user_data.persona.avatar, 
            genero:$scope.genero_edit, 
            fechan:$("#fechan_edit").val(), 
            direccion:$scope.direccion_edit, 
            email:$scope.email_edit,
            estado:$scope.aux_edit_user_data.persona.estado
        };

        var Usuario={
            Persona: data_persona,
            file: $scope.file_edit
        };
        $("#progress").modal("show");
        
        Upload.upload({
            url: API_URL + "User/update_user/" + $scope.aux_edit_user_data.persona.id_pe,
            method: 'POST',
            data: Usuario
        }).success(function(data, status, headers, config) {
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


    ///---
    $scope.Msm_estado="";
    $scope.aux_estado_user={};
    $scope.int_estado=function(item){
        $scope.aux_estado_user=item;
        if($scope.aux_estado_user.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar el usuario";
        }else{
            $scope.Msm_estado=" Esta seguro de activar el usuario";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_user.estado.toString()=="1")?"0":"1";

      var Usuario={
        id_u:$scope.aux_estado_user.id_u,
        estado:aux_estado
      };
      $http.get(API_URL + 'User/estado/' + JSON.stringify(Usuario))
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



    ///---
    $scope.clear=function() {
        $scope.ci=""; 
        $scope.nombre=""; 
        $scope.apellido=""; 
        $scope.avatar=""; 
        $scope.genero="";
        $scope.fechan="";
        $scope.direccion=""; 
        $scope.email="";

        $scope.username="";
        $scope.password="";

        $scope.file="";

        ///--edit

        $scope.ci_edit=""; 
        $scope.nombre_edit=""; 
        $scope.apellido_edit=""; 
        $scope.avatar_edit=""; 
        $scope.genero_edit="";
        $scope.fechan_edit="";
        $scope.direccion_edit=""; 
        $scope.email_edit="";


        $scope.file_edit="";

        $scope.url_foto="";

        //reload datos de lista 
        $scope.initLoad(1);

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