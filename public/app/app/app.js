var app=angular.module("System_Core",["ngRoute",'angularUtils.directives.dirPagination',"ngFileUpload"]);

//app.constant('API_URL', 'http://127.0.0.1:8000/system_core/public/');
app.constant('API_URL', 'http://127.0.0.1:8000/');

app.config(function($routeProvider,API_URL){
	$routeProvider
	.when("/RegistroUsuario",{
		templateUrl : "app/view/bo/Usuario/ViewUsuario.php",
		controller : "LogicaUsuario"
	})
	.when("/RolesUsuario",{
		templateUrl : "app/view/bo/Usuario/ViewRol.php",
		controller : "LogicaRol"
	})
	.when("/RegistroProveedor",{
		templateUrl : "app/view/bo/Personas/ViewProveedor.php",
		controller : "LogicaProveedor"
	})
	.when("/RegistroEmpleado",{
		templateUrl : "app/view/bo/Personas/ViewEmpleado.php",
		controller : "LogicaEmpleado"
	})
	.when("/RegistroCliente",{
		templateUrl : "app/view/bo/Personas/ViewCliente.php",
		controller : "LogicaCliente"
	})
	.when("/RegistroCargo",{
		templateUrl : "app/view/bo/Personas/ViewCargo.php",
		controller : "LogicaCargo"
	})
	.when("/Agenda",{
		templateUrl : "app/view/bo/LSysMedico/Agenda/ViewAgenda.php",
		controller : "LogicaAgenda"
	}).when("/AgendaPerson",{
        templateUrl : "app/view/bo/LSysMedico/Agenda/ViewAgendaPerson.php",
        controller : "LogicaAgendaPerson"
    }).when("/RegistroEmpresa",{
        templateUrl : "app/view/bo/Basico/ViewEmpresa.php",
        controller : "LogicaEmpresa"
    })
    .when("/Pais",{
        templateUrl : "app/view/bo/Basico/ViewPais.php",
        controller : "LogicaPais"
    })
	.otherwise({
        //template : "<h1>Nada</h1><p>Ejemplo de pagina no encotrada,</p>"
        templateUrl : "app/view/bo/LSysMedico/Graficos/ViewGraficosBasico.php",
        controller : "GraficosDefault"
    });
});
