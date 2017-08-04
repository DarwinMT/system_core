<!DOCTYPE html>
<html lang="en" ng-app="System_Core">
<head>
	<title>Inicio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Jquery-->
    <script src="<?= asset('../js/jquery-3.1.1.min.js') ?>"></script>

    <!--Materialize-->
    <!--Import Google Icon Font-->
      	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="<?= asset('../assetsm/js/materialize.min.js') ?>"></script>
	<link href="<?= asset('../assetsm/css/materialize.min.css') ?>" rel="stylesheet">
	
	<!--Angular-->
	<script src="<?= asset('../app/angular/angular.min.js') ?>"></script>
	<script src="<?= asset('../app/angular/angular-route.min.js') ?>"></script>
		<!--Aplicacion-->
	<script src="<?= asset('../app/app/app.js') ?>"></script>
		<!--Controller-->
    

<script type="text/javascript">
$(document).ready(function() {
  $(".button-collapse").sideNav();
  $(".dropdown-button").dropdown();
});
</script>
</head>
<body >
 <nav>
  <div class="nav-wrapper ">
      <a href="#!" class="brand-logo">SystemCore</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown1">
            <i class="material-icons prefix">domain</i> Sistema <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown1" class="dropdown-content" >
              <li><a href="">Empresa</a></li>
            </ul>
        </li>

        <li class="divider"></li>

        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown2">
            <i class="material-icons prefix">local_offer</i> Configuracion <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown2" class="dropdown-content" >
              <li><a href="">Pais</a></li>
              <li><a href="">Provincia</a></li>
              <li><a href="">Ciudad</a></li>
            </ul>
        </li>


        <li class="divider"></li>

        
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown20">
            <i class="material-icons prefix">assignment</i> Administracion <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown20" class="dropdown-content" >
            <li><a href="">Registro De Cliente (Paciente)</a></li>
              <li><a href="">Registro De Empleado (Personal Medico)</a></li>
              <li><a href="">Registro De Proveedor</a></li>
              <li><a href="">Anamnesis Cliente (Paciente) </a></li>
              <li><a href="">Historial Cliente</a></li>
              <li><a href="">Citas  (Agenda)</a></li>
              <li><a href="">Historial Citas  (Agenda)</a></li>
              <li><a href="">Historial Citas  (Agenda)</a></li>
            </ul>
        </li>
        

        
        <li class="divider"></li>

        <!-- Dropdown Trigger -->
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown10">
            <i class="material-icons prefix">account_circle</i> <?php echo " ".$data_user[0]->username; ?> <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown10" class="dropdown-content" >
              <li><a href="">Perfil</a></li>
              <li class="divider"></li>
              <li><a href="logout_system">Salir</a></li>
            </ul>
        </li>


      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown1">
            <i class="material-icons prefix">domain</i> Sistema <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown1" class="dropdown-content" >
              <li><a href="">Empresa</a></li>
            </ul>
        </li>

         <li class="divider"></li>

        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown2">
            <i class="material-icons prefix">local_offer</i> Configuracion <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown2" class="dropdown-content" >
              <li><a href="">Pais</a></li>
              <li><a href="">Provincia</a></li>
              <li><a href="">Ciudad</a></li>
            </ul>
        </li>

        <li class="divider"></li>

        
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown20">
            <i class="material-icons prefix">assignment</i> Administracion <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown20" class="dropdown-content" >
            <li><a href="">Registro De Cliente (Paciente)</a></li>
              <li><a href="">Registro De Empleado (Personal Medico)</a></li>
              <li><a href="">Registro De Proveedor</a></li>
              <li><a href="">Anamnesis Cliente (Paciente) </a></li>
              <li><a href="">Historial Cliente</a></li>
              <li><a href="">Citas  (Agenda)</a></li>
              <li><a href="">Historial Citas  (Agenda)</a></li>
              <li><a href="">Historial Citas  (Agenda)</a></li>
            </ul>
        </li>

        
        <li class="divider"></li>        
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown10">
            <i class="material-icons prefix">account_circle</i> <?php echo " ".$data_user[0]->username; ?> <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown10" class="dropdown-content" >
              <li><a href="">Perfil</a></li>
              <li class="divider"></li>
              <li><a href="logout_system">Salir</a></li>
            </ul>
        </li>


      </ul>
  </div>
</nav>

</body>
</html>