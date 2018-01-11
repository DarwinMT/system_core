app.controller('LogicaPerfil', function($scope, $http, API_URL,Upload) {
    $scope.Title="Perfil Usuario";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.newusersin="0";

    ///---
    /*$scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'User')
        .success(function(response){
            console.log(response[0].id_men);
            if(response[0].id_men!= undefined  ){ // no tiene session activa
                $scope.list_permisos=response[0];
            }else{
                location.reload();
            }
        });
    };*/


    ///---


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

    $scope.get_me=function () {
        $http.get(API_URL + 'User/get_me')
        .success(function(response){
            console.log(response[0]);
           $scope.init_edit(response[0]);
           $scope.init_chage_user(response[0]);
        });
    };
    $scope.get_me();


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
            }else{
                $("#progress").modal("hide");
                sms("btn-danger","Error al guardar la transacción..!!");
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

        $scope.id_r="";

        $scope.aux_user_access={};

        $scope.aux_edit_user={};
        $scope.aux_username="";
        $scope.aux_password="";

        $scope.result_valida_user=0;
        $scope.valida_usernew=0;
        $scope.valida_dninew=0;
        $scope.valida_dniedit=0;


        $("#vista_user_new").removeClass("has-success");
        $("#vista_user_new").removeClass("has-error");
        $("#vista_dni_new").removeClass("has-success");
        $("#vista_dni_new").removeClass("has-error");
        $("#vista_dni_edit").removeClass("has-success");
        $("#vista_dni_edit").removeClass("has-error");

    };
    ///---

    ///---

    $scope.aux_edit_user={};
    $scope.aux_username="";
    $scope.aux_password="";
    $scope.result_valida_user=0;
    $scope.init_chage_user=function(item){
        $scope.aux_edit_user=item;
        $scope.aux_username=$scope.aux_edit_user.username;
        $("#vista_user_edit").removeClass("has-success");
        $("#vista_user_edit").removeClass("has-error");
        $("#modal_userpass").modal("show");
    };

    $scope.valida_user_edit=function(){

        var usuario={
            id: $scope.aux_edit_user.id_u,
            username:$scope.aux_username.trim()
        };

        $http.get(API_URL + 'User/valida_user/'+JSON.stringify(usuario))
        .success(function(response){
            $scope.result_valida_user=parseInt(response);
            $("#vista_user_edit").removeClass("has-success");
            $("#vista_user_edit").removeClass("has-error");
            if(parseInt($scope.result_valida_user)==0){
                $("#vista_user_edit").addClass("has-success");
            }else{
                $("#vista_user_edit").addClass("has-error");
            }
        });  
    };

    $scope.edit_userpass=function(){
        if($scope.result_valida_user==0 && $scope.aux_username!="" && $scope.aux_password!=""){
            $("#progress").modal("show");
            var usuario={
                id_u: $scope.aux_edit_user.id_u,
                username:$scope.aux_username.trim(),
                password: $scope.aux_password.trim()
            };
            $http.get(API_URL + 'User/save_chage_user/'+JSON.stringify(usuario))
            .success(function(response){
              console.log(response);
                if(response.success==0){
                    $("#modal_userpass").modal("hide");
                    $("#progress").modal("hide");
                    sms("btn-success","Se guardo correctamente los datos..!!");
                }else{
                    $("#progress").modal("hide");
                    sms("btn-danger","Error al guardar los datos..!!");
                }  
            });
        }else{
            sms("btn-warning","Ingrese todos los datos para guardar la transacción");
        }
    };
    ///---

    ///---
    $scope.valida_usernew=0;
    $scope.valida_user_new=function(){
        var usuario={
            id: '',
            username:$scope.username.trim()
        };
        $http.get(API_URL + 'User/valida_user/'+JSON.stringify(usuario))
        .success(function(response){
            $scope.valida_usernew=parseInt(response);
            $("#vista_user_new").removeClass("has-success");
            $("#vista_user_new").removeClass("has-error");
            if(parseInt($scope.valida_usernew)==0){
                $("#vista_user_new").addClass("has-success");
            }else{
                $("#vista_user_new").addClass("has-error");
            }
        });  
    };

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

    $scope.valida_dniedit=0;
    $scope.valida_user_dni_edit=function(){
        var usuario={
            id: $scope.aux_edit_user_data.persona.id_pe,
            ci:$scope.ci_edit.trim()
        };
        $http.get(API_URL + 'User/valida_dni/'+JSON.stringify(usuario))
        .success(function(response){
            $scope.valida_dniedit=parseInt(response);
            $("#vista_dni_edit").removeClass("has-success");
            $("#vista_dni_edit").removeClass("has-error");
            if(parseInt($scope.valida_dniedit)==0){
                $("#vista_dni_edit").addClass("has-success");
            }else{
                $("#vista_dni_edit").addClass("has-error");
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