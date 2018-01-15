var app=angular.module("System_Core",["ngRoute","ngFileUpload"]);

//app.constant('API_URL', 'http://127.0.0.1:8000/system_core/public/');
app.constant('API_URL', 'http://127.0.0.1:8000/');

app.config(function($routeProvider,API_URL){
	$routeProvider
	.when("/Citas",{
		templateUrl : "app/view/ma/LSysMedico/Agenda/ViewCitas.php",
		controller : "LogicaListaCitasPersona"
	})
	.when("/CrearCita",{
		templateUrl : "app/view/ma/LSysMedico/Agenda/ViewCrearCitas.php",
		controller : "LogicaAgendaCitasPersona"
	})
	.otherwise({
        templateUrl : "app/view/ma/LSysMedico/Agenda/ViewCitas.php",
		controller : "LogicaListaCitasPersona"
    });
});
