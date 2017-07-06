app.controller('Login', function($scope, $http, API_URL) {
    $scope.Name_Company="Company Name";
    $scope.username="";
    $scope.password="";
    $scope.Mensaje_Start="";
    ///--- Incio de login
    $scope.start_login=function(){
        var data_login={
            User: $scope.username,
            Password: $scope.password
        };
        $http.post(API_URL+'Login',data_login)
        .success(function (response) {
            if(response.success==1){ //usuario incorrecto
                $scope.Mensaje_Start="Usuario Incorrecto";
            }else if(response.success==2){ // clave incorrecta
                $scope.Mensaje_Start="Contraseña Incorrecta";
            }else{
                $scope.Mensaje_Start="";
            }
        })
        .error(function(err){
            console.log(err);
        });
    };
});


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

function QuitarClasesMensaje() {
    $("#titulomsm").removeClass("btn-primary");
    $("#titulomsm").removeClass("btn-warning");
    $("#titulomsm").removeClass("btn-success");
    $("#titulomsm").removeClass("btn-info");
    $("#titulomsm").removeClass("btn-danger");
}
$(document).ready(function(){
});