var app=angular.module("System_Core",["ngRoute"]);

//app.constant('API_URL', 'http://127.0.0.1:8000/system_core/public/');
app.constant('API_URL', 'http://127.0.0.1:8000/');

app.config(function($routeProvider){
	$routeProvider
	.when("/",{
		templateUrl : "app/view/bo/main.html",
		controller : "home"
	})
	.when("/AddPersona",{
		templateUrl : "app/view/bo/persona/add.html",
		controller : "AgregarPersona"
	})
	.when("/ListClient",{
		templateUrl : "app/view/bo/persona/clientes.html",
		controller : "ListaClientes"
	})
	.otherwise({
        template : "<h1>Nada</h1><p>Ejemplo de pagina no encotrada,</p>"
    });
});
