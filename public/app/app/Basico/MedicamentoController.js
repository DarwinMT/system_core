app.controller('LogicaVademecum', function($scope, $http, API_URL,Upload) {
    $scope.Title="Vademécum Farmacológico";
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
        $http.get(API_URL + 'Vademecum')
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
    $scope.list_vademecum=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $http.get(API_URL + 'Vademecum/get_list_vademecum?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_vademecum = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.list_vademecum_excell=[];
    $scope.excell_Vademecum=function(){
        $("#progress").modal("show");
        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $scope.list_vademecum_excell=[];
        $http.get(API_URL + 'Vademecum/get_medicamentos/' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_vademecum_excell = response.data;
                console.log($scope.list_vademecum_excell);

                setTimeout(function(){
                    $("#list_country").table2excel({
                        exclude: ".noExl",
                        name: "Lista De Medicamentos",
                        filename: "Lista De Medicamentos" 
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
        $scope.presentacion="";

        $scope.initLoad(1);
    };
    ///---

    ///---
    $scope.save=function() {
        $("#progress").modal("show");
        var f=new Date();
        var Vademecum_data={
            fechaingreso: f.getFullYear()+"-"+(f.getMonth()+1)+"-"+f.getDate(),
            id_clasit:1,
            descripcion: $scope.descripcion.trim(),
            presentacion: $scope.presentacion.trim(),
            estado: '1'
        };
        $http.post(API_URL + 'Vademecum',Vademecum_data)
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
    $scope.aux_Vademecum={};
    $scope.init_edit=function(item){
        $scope.aux_Vademecum=item;
        $scope.newedid="2";
        $scope.descripcion=$scope.aux_Vademecum.descripcion;
        $scope.presentacion=$scope.aux_Vademecum.presentacion;
    };
    $scope.edit=function(){
        $scope.aux_Vademecum.descripcion=$scope.descripcion;
        $scope.aux_Vademecum.presentacion=$scope.presentacion;
        $http.put(API_URL + 'Vademecum/'+$scope.aux_Vademecum.id_item,$scope.aux_Vademecum)
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
    $scope.aux_estado_Vademecum={};
    $scope.int_estado=function(item){
        $scope.aux_estado_Vademecum=item;
        if($scope.aux_estado_Vademecum.estado.toString()=="1"){
            $scope.Msm_estado=" Esta seguro de inactivar el Medicamento";
        }else{
            $scope.Msm_estado=" Esta seguro de activar el Medicamento";
        }
        $("#modalestado").modal("show");
    };
    $scope.update_estado=function(){
      $("#modalestado").modal("hide");
      $("#progress").modal("show");
      var aux_estado=($scope.aux_estado_Vademecum.estado.toString()=="1")?"0":"1";

      var Vademecum={
        id_item:$scope.aux_estado_Vademecum.id_item,
        estado:aux_estado
      };
      $http.get(API_URL + 'Vademecum/estado/' + JSON.stringify(Vademecum))
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