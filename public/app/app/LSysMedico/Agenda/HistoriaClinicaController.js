app.controller('LogicaHistoriaClinica', function($scope, $http, API_URL,Upload) {
    $scope.Title="Historial Clínico Cliente";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $scope.newedid="0";
    $scope.estadoanulado="1";

    /*var f = new Date();
    var dd = f.getDate();
    if (dd < 10) dd = '0' + dd;
    var mm = f.getMonth() + 1;
    if (mm < 10) mm = '0' + mm;

    $scope.fecha_desde=f.getFullYear()+"-"+mm+"-01";
    $scope.fecha_hasta=f.getFullYear()+"-"+mm+"-"+dd;*/
    
    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Historia')
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
    $scope.list_Historia=[];
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
            buscar:$scope.buscartexto,
            /*fechai: $("#fecha_desde").val(),
            fechaf: $("#fecha_hasta").val()*/
        };
        $http.get(API_URL + 'Historia/get_paciente_historia?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                console.log(response.data.data);
                $scope.list_Historia = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };
    $scope.initLoad(1);
    ///---

    ///---
    $scope.list_Historia_excell=[];
    $scope.excell_Historia=function(){
        $("#progress").modal("show");
        var filtros = {
            buscar:$scope.buscartexto,
            estado: $scope.estadoanulado
        };
        $scope.list_Historia_excell=[];
        $http.get(API_URL + 'Historia/get_medicamentos/' + JSON.stringify(filtros))
            .then(function(response){
                $scope.list_Historia_excell = response.data;
                console.log($scope.list_Historia_excell);

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
    $scope.aux_Historia={};
    $scope.list_anamnesiscliente=[];
    $scope.totalItemsanamnesis="";
    $scope.pageChanged_anamnesis = function(newPage) {
        $scope.get_dataanamanesis(newPage);
    };
    $scope.init_see=function(item){
        $scope.aux_Historia=item;
        $scope.newedid="2";
        $scope.get_dataanamanesis(1);
    };
    $scope.get_dataanamanesis=function (pageNumber) {
        var filtros = {
            id_cli:$scope.aux_Historia.id_cli
        };
       $http.get(API_URL + 'Historia/get_listanamnesis_cliente?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                console.log(response.data.data);
                $scope.list_anamnesiscliente = response.data.data;
                $scope.totalItemsanamnesis = response.data.total;
        });  
    };
    
    ///---

    ///---
    $scope.print_anamnesis=function (item) {
        console.log(item)
        if(item.consultageneral.length>0){// tiene consulta externa
            var data={
                id_cone:item.consultageneral[0].id_cone,
                id_ag:item.consultageneral[0].id_ag
            };
            var accion = API_URL + "Anamnesis/print_anamnesis/"+JSON.stringify(data);
            $("#WPrint_head").html("Anamnesis");
            $("#WPrint").modal("show");
            $("#bodyprint").html("<object width='100%' height='600' data='"+accion+"'></object>");
        }else{
            sms("btn-info","Ingrese la Anamnesis para poder imprimir");
        }
    };
    $scope.print_receta=function (item) {
        console.log(item)
        if(item.consultageneral.length>0){// tiene consulta externa
            if(item.consultageneral[0].prescripcion.length>0){// tiene una receta
                var data={
                    id_cone:item.consultageneral[0].id_cone,
                    id_ag:item.consultageneral[0].id_ag
                };
                var accion = API_URL + "Prescripcion/print_receta/"+JSON.stringify(data);
                $("#WPrint_head").html("Receta");
                $("#WPrint").modal("show");
                $("#bodyprint").html("<object width='100%' height='600' data='"+accion+"'></object>");
            }else{
                sms("btn-info","Ingrese una Receta para poder imprimir");
            }
        }else{
            sms("btn-info","Ingrese la Anamnesis para poder recetar");
        }
    };
    ///---



    ///---
    $scope.calcular_edad=function(fecha) {
        if(fecha==undefined  || fecha==null) return "";

        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }

        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;

        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        return edad+" años, "+meses+" meses y "+dias+" días";
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