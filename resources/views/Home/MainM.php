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
        <li><a href="sass.html">Home</a></li>
        <li><a href="badges.html">About</a></li>
        <li><a href="collapsible.html">Contact</a></li>
        <!-- Dropdown Trigger -->
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown1">
            <i class="material-icons prefix">account_circle</i> <?php echo " ".$data_user[0]->username; ?> <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown1" class="dropdown-content" >
              <li><a href="">Perfil</a></li>
              <li class="divider"></li>
              <li><a href="logout_system">Salir</a></li>
            </ul>
        </li>


      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="sass.html">Home</a></li>
        <li><a href="badges.html">About</a></li>
        <li><a href="collapsible.html">Contact</a></li>
        <!-- Dropdown Trigger -->
        <li>
          <a class="dropdown-button" href="#!" data-activates="dropdown1">
            <i class="material-icons prefix">account_circle</i> <?php echo " ".$data_user[0]->username; ?> <i class="material-icons right">arrow_drop_down</i> </a>
            <ul id="dropdown1" class="dropdown-content" >
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