app.controller('LogicaEmpresa', function($scope, $http, API_URL,Upload) {
    $scope.Title="Registro Empresa";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

  
    
    ///---
    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Company')
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
   $scope.data_empresa=[];
   $scope.id_emp="";
   $scope.nombre="";
   $scope.ruc="";
   $scope.id_pa="";
   $scope.provincia="";
   $scope.id_ci="";
   $scope.id_pro="";
   $scope.direccion="";
   $scope.telefono="";
   $scope.file="";
    $scope.initLoad = function(){
    	$scope.data_empresa=[];
    	$http.get(API_URL + 'Company/get_infoempresa')
            .then(function(response){
               $scope.data_empresa = response.data;
               console.log($scope.data_empresa);
               $scope.id_emp=$scope.data_empresa[0].id_emp;
               $scope.nombre=$scope.data_empresa[0].nombre;
			   $scope.ruc=$scope.data_empresa[0].ruc;
			   $scope.direccion=$scope.data_empresa[0].direccion;
			   $scope.telefono=$scope.data_empresa[0].telefono;
			   $scope.file="";

			   $scope.url_foto=$scope.data_empresa[0].logo;
			   $scope.loadpaises($scope.data_empresa[0].ciudad.provincia.id_pa);
			   $scope.loadprovincia($scope.data_empresa[0].ciudad.provincia.id_pa, $scope.data_empresa[0].ciudad.id_pro);
			   $scope.loadcioudad($scope.data_empresa[0].ciudad.id_pro, $scope.data_empresa[0].ciudad.id_ci );
        });
    };
    $scope.initLoad();
    ///---

    ///---
    $scope.list_ciudad=[];
    $scope.loadcioudad = function(idprovincia, idciudad){
    	$scope.list_ciudad=[];
    	var filtro={
    		id_pro:idprovincia
    	};
    	$http.get(API_URL + 'Ciudad/get_ciudades/' + JSON.stringify(filtro))
            .then(function(response){
                $scope.list_ciudad = response.data;
                $scope.id_ci= idciudad.toString();
        });
    };
    $scope.list_provincia=[];
    $scope.loadprovincia = function(idpais, idprovincia){
    	$scope.list_provincia=[];
    	var filtro={
    		id_pa:idpais
    	};
    	$http.get(API_URL + 'Provincia/get_provincias/' + JSON.stringify(filtro))
            .then(function(response){
                $scope.list_provincia = response.data;
                $scope.id_pro=idprovincia.toString();
        });
    };
    $scope.list_pais=[];
    $scope.loadpaises = function(idpais){
    	$scope.list_pais=[];
    	var filtro={
    		id_pa:idpais
    	};
    	$http.get(API_URL + 'Pais/get_paises/' + JSON.stringify(filtro))
            .then(function(response){
                $scope.list_pais = response.data;
                $scope.id_pa=idpais.toString();
        });
    };
    ///---

    ///---
    $scope.clear=function(){
        $scope.neweditrol="0";
        $scope.descripcion="";

        $scope.initLoad(1);
    };
    ///---

 
    ///---

    $scope.edit=function(){
        var empresa_data={
            Empresa:{
            	nombre:$scope.nombre,
				ruc:$scope.ruc,
				id_ci:$scope.id_ci,
				direccion:$scope.direccion,
				telefono:$scope.telefono
            },
            file: $scope.file
        };
        $("#progress").modal("show");
        
        Upload.upload({
            url: API_URL + "Company/update_empresa/" + $scope.id_emp,
            method: 'POST',
            data: empresa_data
        }).success(function(data, status, headers, config) {
        	console.log(data);
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