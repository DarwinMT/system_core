var app=angular.module("Ce",["ngRoute"]);
app.config(function($routeProvider){
	$routeProvider
	.when("/",{
		templateUrl : "app/view/ma/main.html",
		controller : "home"
	})
	.when("/Report",{
		templateUrl : "app/view/bo/main.html",
		controller : "home"
	})
	.otherwise({
        template : "<h1>Nada</h1><p>Ejemplo de pagina no encotrada,</p>"
    });
});
