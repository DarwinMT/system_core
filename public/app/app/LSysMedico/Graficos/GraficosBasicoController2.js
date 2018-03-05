app.controller('GraficosDefault2', function($scope, $http, API_URL,Upload) {
    $scope.Title="Gráficos Estadísticos ";
    $('.datepicker').datetimepicker({
        locale: 'es',
        //format: 'DD/MM/YYYY',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true
    });

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    });


    $scope.FechaI="";
    $scope.FechaF="";
    var f= new Date();
    var dia=f.getDate();
    dia=(dia<10)? ("0"+dia):(dia);
    var mes = (f.getMonth()+1);
    mes =(mes<10)? ("0"+mes):(mes);
    var fechai=f.getFullYear()+"-"+mes+"-01";
    var fechaf=f.getFullYear()+"-"+mes+"-"+dia;

    console.log(fechai);
    console.log(fechaf);

    $scope.FechaI=fechai;
    $scope.FechaF=fechaf;
    

    $('#fecha_desde').on('dp.change', function(e){
        $scope.FechaI=$(this).val();
    });
    $('#fecha_hasta').on('dp.change', function(e){
        $scope.FechaF=$(this).val();
    });

    
    $scope.call_all_and_getdatos=function() {
        var filtro={
            fechai: $scope.FechaI,
            fechaf: $scope.FechaF,
        };
        var rango=" Desde: "+ $scope.FechaI+" , Hasta: "+ $scope.FechaF;
        $scope.get_numbercitas(filtro, "Número de citas "+rango+"");
        $scope.get_numberenfermedadesfamiliares(filtro);
        $scope.get_datadiagnosticos(filtro,"Diagnosticos "+rango+"");
        $scope.get_datadmvademecum(filtro,"Medicamentos  "+rango+"");
    };


    $scope.list_permisos=[];
    $scope.permisos_user=function () {
        $http.get(API_URL + 'Agenda')
        .success(function(response){
            console.log(response[0].id_men);
            if(response[0].id_men!= undefined  ){ // no tiene session activa
                $scope.list_permisos=response[0];
            }else{
                location.reload();
            }
        });
    };

    $scope.get_numbercitas=function (filtros, titulografico) {

        $http.get(API_URL + 'Agenda/get_numbercitas_filtro/' + JSON.stringify(filtros))
        //$http.get(API_URL + 'Agenda/get_numbercitas')
        .success(function(response){
            console.log(response);
            var datos=[];
            var titles=[];
            var colores=[];
            var border=[];
            response.forEach(function(i) {
                datos.push(i.numero);
                titles.push(i.fecha);
                var color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                colores.push(color);
                border.push(color);
            });
            var ctx = document.getElementById("number_citas").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: titles,
                    datasets: [{
                        label: titulografico,
                        data: datos,
                        backgroundColor:colores,
                        borderColor: border,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    };

    //$scope.get_numbercitas(); 


    $scope.get_numberenfermedadesfamiliares=function (filtros) {
        $http.get(API_URL + 'Anamnesis/get_enfermedadesfamiliares_filtro/' + JSON.stringify(filtros))
        .success(function(response){
            console.log(response);
          var datos=[];
            var titles=[];
            var colores=[];
            var border=[];
            var color="";
            
                
                if (response.Cancer!=0) {
                    datos.push(response.Cancer);
                    titles.push("Cancer");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Cardiopatia!=0) {
                    datos.push(response.Cardiopatia);
                    titles.push("Cardiopatia");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Diabetes!=0) {
                    datos.push(response.Diabetes);
                    titles.push("Diabetes");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Enfermedad_infecciosa!=0) {
                    datos.push(response.Enfermedad_infecciosa);
                    titles.push("Enfermedad infecciosa");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Enfermedad_mental!=0) {
                    datos.push(response.Enfermedad_mental);
                    titles.push("Enfermedad mental");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Hipertencion!=0) {
                    datos.push(response.Hipertencion);
                    titles.push("Hipertencion");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Malformacion!=0) {
                    datos.push(response.Malformacion);
                    titles.push("Malformacion");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Otro!=0) {
                    datos.push(response.Otro);
                    titles.push("Otro");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Tuberculosis!=0) {
                    datos.push(response.Tuberculosis);
                    titles.push("Tuberculosis");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                if (response.Vascular!=0) {
                    datos.push(response.Vascular);
                    titles.push("Cardio Vascular");
                    color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                    colores.push(color);
                    border.push(color);
                }

                console.log(colores)
            var ctx = document.getElementById("number_enfermedadgenerales").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: titles,
                    datasets: [{
                        label: 'Enfermedades Comunes',
                        data: datos,
                        backgroundColor:colores,
                        borderColor: border,
                        borderWidth: 1
                    }]
                }
            });
        });
    };

    

    $scope.get_datadiagnosticos=function (filtros, titulografico) {
        $http.get(API_URL + 'Anamnesis/get_diagnosticos_filtro/' + JSON.stringify(filtros))
        .success(function(response){
            console.log(response);
            var datos=[];
            var titles=[];
            var colores=[];
            var border=[];
            response.forEach(function(i) {
                datos.push(i.Cantidad);
                titles.push(i.Diagnosticos);
                var color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                colores.push(color);
                border.push(color);
            });
            var ctx = document.getElementById("number_diagnosticos").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: titles,
                    datasets: [{
                        label: titulografico,
                        data: datos,
                        backgroundColor:colores,
                        borderColor: border,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    };
    


    $scope.get_datadmvademecum=function (filtros, titulografico) {
        $http.get(API_URL + 'Prescripcion/get_datavademecum_filtro/' + JSON.stringify(filtros))
        .success(function(response){
            console.log(response);
            var datos=[];
            var titles=[];
            var colores=[];
            var border=[];
            response.forEach(function(i) {
                datos.push(i.Cantidad);
                titles.push(i.Medicamento);
                var color = "rgba(" + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ", " + (Math.round(Math.random() * (250))) + ",0.2)";
                colores.push(color);
                border.push(color);
            });
            var ctx = document.getElementById("number_medicamentos").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: titles,
                    datasets: [{
                        label: titulografico,
                        data: datos,
                        backgroundColor:colores,
                        borderColor: border,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    };
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
