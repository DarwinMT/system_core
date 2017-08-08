var app=angular.module("System_Core",["ngRoute"]);

//app.constant('API_URL', 'http://127.0.0.1:8000/system_core/public/');
app.constant('API_URL', 'http://127.0.0.1:8000/');

app.config(function($routeProvider,API_URL){
	$routeProvider
	/*.when("/",{
		templateUrl : "<h1>Nada</h1><p>Ejemplo de pagina no encotrada,</p>"
	})*/
	.when("/RegistroUsuario",{
		templateUrl : "app/view/bo/Usuario/ViewUsuario.php",
		controller : "LogicaUsuario"
	})
	.otherwise({
        template : "<h1>Nada</h1><p>Ejemplo de pagina no encotrada,</p>"
    });
});
