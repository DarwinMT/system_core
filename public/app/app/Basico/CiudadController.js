app.controller('LogicaCiudad', function($scope, $http, API_URL,Upload) {
    $scope.Title="Registro De Ciudades";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.newedid="0";
    $scope.estadoanulado="1";
    
    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Ciudad')
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
    $scope.list_Ciudad=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'Ciudad/get_list_ciudades?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_Ciudad = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.list_pais=[];
    $scope.id_pa="";
    $scope.loadpaises = function(){
        $scope.list_pais=[];
        var filtro={
            id_pa:1
        };
        $http.get(API_URL + 'Pais/get_paises/' + JSON.stringify(filtro))
            .then(function(response){
                $scope.list_pais = response.data;
        });
    };
    $scope.loadpaises();
    $scope.list_provincia=[];
    $scope.id_pro="";
    $scope.loadprovincia = function(idpais, idprovincia){
        if(idpais.toString()!=""){
            $scope.list_provincia=[];
            var filtro={
                id_pa:idpais
            };
            $http.get(API_URL + 'Provincia/get_provincias/' + JSON.stringify(filtro))
                .then(function(response){
                    $scope.list_provincia = response.data;
                    if(idprovincia!=null || idprovincia!=undefined) $scope.id_pro=idprovincia.toString();
            });
        }
    };
    ///---

    ///---
    $scope.list_Ciudad_excell=[];
    $scope.excell_Ciudad=function(){
        $("#progress").modal("show");
        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $scope.list_Ciudad_excell=[];
        $http.get(API_URL + 'Ciudad/get_ciudades_all/' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_Ciudad_excell = response.data;
                console.log($scope.list_Ciudad_excell);

                setTimeout(function(){
                    $("#list_country").table2excel({
                        exclude: ".noExl",
                        name: "Lista De Ciudades",
                        filename: "Lista De Ciudades" 
                    });
                    $("#progress").modal("hide");
                },1000);
         });

    };
    ///---

    ///---
    $scope.clear=function(){
        $scope.newedid="0";
        $scope.descripcion="";

        $scope.initLoad(1);
    };
    ///---

    ///---
    $scope.save=function() {
        $("#progress").modal("show");
        var Ciudad_data={
            id_pro: $scope.id_pro,
            descripcion: $scope.descripcion.trim(),
            estado: '1'
        };
        $http.post(API_URL + 'Ciudad',Ciudad_data)
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
    $scope.aux_Ciudad={};
    $scope.init_edit=function(item){
        $scope.aux_Ciudad=item;
        $scope.newedid="2";
        $scope.id_pa=$scope.aux_Ciudad.provincia.id_pa.toString();
        $scope.loadprovincia($scope.aux_Ciudad.provincia.id_pa,$scope.aux_Ciudad.provincia.id_pro );
        $scope.descripcion=$scope.aux_Ciudad.descripcion;
    };
    $scope.edit=function(){
        $scope.aux_Ciudad.id_pro=$scope.id_pro;
        $scope.aux_Ciudad.descripcion=$scope.descripcion;
        $http.put(API_URL + 'Ciudad/'+$scope.aux_Ciudad.id_ci,$scope.aux_Ciudad)
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
    $scope.aux_estado_Ciudad={};
    $scope.int_estado=function(item){
        $scope.aux_estado_Ciudad=item;
        if($scope.aux_estado_Ciudad.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar la Ciudad";
        }else{
            $scope.Msm_estado=" Esta seguro de activar la Ciudad";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_Ciudad.estado.toString()=="1")?"0":"1";

      var Ciudad={
        id_ci:$scope.aux_estado_Ciudad.id_ci,
        estado:aux_estado
      };
      $http.get(API_URL + 'Ciudad/estado/' + JSON.stringify(Ciudad))
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