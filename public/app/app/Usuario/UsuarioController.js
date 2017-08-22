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

        $scope.id_r="";

        $scope.aux_user_access={};

        $scope.aux_edit_user={};
        $scope.aux_username="";
        $scope.aux_password="";

        $scope.result_valida_user=0;
        $scope.valida_usernew=0;
        $scope.valida_dninew=0;
        $scope.valida_dniedit=0;

        //reload datos de lista 
        $scope.initLoad(1);

        $("#vista_user_new").removeClass("has-success");
        $("#vista_user_new").removeClass("has-error");
        $("#vista_dni_new").removeClass("has-success");
        $("#vista_dni_new").removeClass("has-error");

    };
    ///---

    ///---
    $scope.menu=[];
    $scope.aux_user_access={};
    $scope.init_permisos=function(item) {
        console.log(item);
        $scope.newusersin='3';

        $scope.id_r="";
        $scope.aux_user_access=item;
        $http.get(API_URL + 'Access/get_list_menu')
        .success(function(response){
            ///console.log(response);
            var nodo=response;
            $scope.menu=[];
            nodo.forEach(function(n){
                var nodos=n.Nodos;
                var aux_nodos=[];
                nodos.forEach(function (i) {
                                    
                    var hijo={
                        id_men :i.id_men,
                        id_nodmen : i.id_nodmen,
                        titulo: i.titulo,
                        url: i.url,
                        html :i.html,
                        estado :i.estado,

                        access_ready:false,
                        access_save:false,
                        access_edit:false,
                        access_delete:false,
                        access_print:false,
                        access_excell: false
                    };
                    aux_nodos.push(hijo);

                });
                var aux_nodo={
                    Nodo:n.Nodo,
                    Nodos: aux_nodos
                };
                $scope.menu.push(aux_nodo);
            });
            console.log($scope.menu);

            if(item.permisos.length) { //tiene permisos
                $scope.id_r= String(item.permisos[0].id_r);
                var permisos_sys=JSON.parse(item.permisos[0].acceso);
                console.log(permisos_sys);

                permisos_sys.forEach(function(a){
                    $scope.menu.forEach(function (x) {
                       x.Nodos.forEach(function(y){
                        if(a.id_men==y.id_men){
                            if(a.access_ready==1){
                                y.access_ready=true;
                            }else{
                                y.access_ready=false;
                            }

                            if(a.access_save==1){
                                y.access_save=true;
                            }else{
                                y.access_save=false;
                            }

                            if(a.access_edit==1){
                                y.access_edit=true;
                            }else{
                                y.access_edit=false;
                            }


                            if(a.access_delete==1){
                                y.access_delete=true;
                            }else{
                                y.access_delete=false;
                            }

                            if(a.access_print==1){
                                y.access_print=true;
                            }else{
                                y.access_print=false;
                            }

                            if(a.access_excell==1){
                                y.access_excell=true;
                            }else{
                                y.access_excell=false;
                            }
                        }

                       }); 
                    });
                });
            }
        });
    };

    $scope.id_r="";
    $scope.list_rol=[];
    $scope.rol=function(){
        $http.get(API_URL + 'Access/get_list_rol')
        .success(function(response){
            console.log(response);
            $scope.list_rol=response;
        });
    };

    $scope.save_permisos=function(){
        if ($scope.id_r!="") {
            $("#progress").modal("show");
            console.log($scope.menu)
            var acceso_sys=[];
            $scope.menu.forEach(function(x){
                x.Nodos.forEach(function(y){
                    if(y.access_ready==true){
                        var item={
                            id_men :y.id_men,
                            id_nodmen : y.id_nodmen,
                            titulo: y.titulo,
                            url: y.url,
                            html :y.html,
                            estado :y.estado,

                            access_ready: ((y.access_ready==true)?1:0) ,
                            access_save:  ((y.access_save==true)?1:0),
                            access_edit:  ((y.access_edit==true)?1:0),
                            access_delete:((y.access_delete==true)?1:0),
                            access_print: ((y.access_print==true)?1:0),
                            access_excell:((y.access_excell==true)?1:0)
                        };
                        acceso_sys.push(item);
                    }
                });
            });
            var permisos={
                id_u : $scope.aux_user_access.id_u,
                id_r:  $scope.id_r, 
                acceso:acceso_sys, 
                estado: 1
            };

            $http.post(API_URL + 'Access',permisos)
            .success(function(response){
                console.log(response);
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
            });

        }else{
            sms("btn-info","Seleccione un rol..!!");
        }
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
                    $scope.clear();
                    $scope.newusersin="0";
                }else{
                    $("#progress").modal("hide");
                    sms("btn-danger","Error al guardar los datos..!!");
                    $scope.clear();
                    $scope.newusersin="0";
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