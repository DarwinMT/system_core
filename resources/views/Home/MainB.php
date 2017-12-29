<!DOCTYPE html>
<html lang="en" ng-app="System_Core">
<head>
	<title>.::SystemCore::.</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Jquery-->
    <script src="<?= asset('../js/jquery-3.1.1.min.js') ?>"></script>


    <!--Bootstrap 3-->
	<script src="<?= asset('../assetsb/js/bootstrap.min.js') ?>"></script>
	<link href="<?= asset('../assetsb/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!--Datetimepicker-->
  <script src="<?= asset('../js/moment.min.js') ?>"></script>
  <script src="<?= asset('../js/es.js') ?>"></script>
  <script src="<?= asset('../js/bootstrap-datetimepicker.min.js') ?>"></script>
  <link href="<?= asset('css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
  <!--Datetimepicker-->

  <!--Excell -->
  <script src="<?= asset('../js/jquery.table2excel.js') ?>"></script>
  <!--Excell -->

  <!--Graficos-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
  <script type="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <!--Graficos-->
  
	<!--Angular-->
	<script src="<?= asset('../app/angular/angular.min.js') ?>"></script>
	<script src="<?= asset('../app/angular/angular-route.min.js') ?>"></script>
    <!--Paginacion angular-->
    <script src="<?= asset('../js/dirPagination.js') ?>"></script>
    <!--Upfile angular-->
    <script src="<?= asset('../js/ng-file-upload-shim.min.js') ?>"></script>
    <script src="<?= asset('../js/ng-file-upload.min.js') ?>"></script>
    
		<!--Aplicacion-->
	<script src="<?= asset('../app/app/app.js') ?>"></script>

  <script src="<?= asset('../app/app/Usuario/UsuarioController.js') ?>"></script>
  <script src="<?= asset('../app/app/Usuario/RolController.js') ?>"></script>
  <script src="<?= asset('../app/app/Personas/ProveedorController.js') ?>"></script>
  <script src="<?= asset('../app/app/Personas/EmpleadoController.js') ?>"></script>
  <script src="<?= asset('../app/app/Personas/ClienteController.js') ?>"></script>
  <script src="<?= asset('../app/app/Personas/CargoController.js') ?>"></script>
  <script src="<?= asset('../app/app/Basico/EmpresaController.js') ?>"></script>
  <script src="<?= asset('../app/app/Basico/PaisController.js') ?>"></script>
    <!--Controller logica medico-->
        <script src="<?= asset('../app/app/LSysMedico/Agenda/AgendaController.js') ?>"></script>
        <script src="<?= asset('../app/app/LSysMedico/Agenda/AgendaControllerPerson.js') ?>"></script>
    <!--Controller-->

    
    <!--Graficos logica angular-->
    <script src="<?= asset('../app/app/LSysMedico/Graficos/GraficosBasicoController.js') ?>"></script>
    <!--Graficos logica angular-->


<style>
  .dropdown-submenu {
      position: relative;
  }
  .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
  }
  body {
    padding-top: 50px;
  }

</style>

<script type="text/javascript">
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    });

});
</script>

	
</head>
<body>
 <nav class="navbar navbar-fixed-top navbar-inverse">
     <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SystemCore</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <?php  echo $acees; ?>          
        </div>
    </div>
</nav>


<div class="container">
  <div class="row">
    <div class="col-md-12 col-xs-12" ng-view>

    </div>
  </div>
</div>




</body>
</html>