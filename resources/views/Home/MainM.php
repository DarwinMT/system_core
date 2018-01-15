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
	<!--<script src="<?= asset('../assetsm/js/materialize.min.js') ?>"></script>
	<link href="<?= asset('../assetsm/css/materialize.min.css') ?>" rel="stylesheet">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	
	<!--Angular-->
	<script src="<?= asset('../app/angular/angular.min.js') ?>"></script>
	<script src="<?= asset('../app/angular/angular-route.min.js') ?>"></script>

    <!--Paginacion angular-->
    <script src="<?= asset('../js/dirPagination.js') ?>"></script>
    <!--Upfile angular-->
    <script src="<?= asset('../js/ng-file-upload-shim.min.js') ?>"></script>
    <script src="<?= asset('../js/ng-file-upload.min.js') ?>"></script>
    
		<!--Aplicacion-->
	<script src="<?= asset('../app/app/appm.js') ?>"></script>
		<!--Controller-->
      <script src="<?= asset('../app/app/LSysMedico/Agenda/ListCitasPersonController.js') ?>"></script>
      <script src="<?= asset('../app/app/LSysMedico/Agenda/AgendarCitasPersonController.js') ?>"></script>
    <!--Controller-->
    
<style type="text/css">
  .header {
      color: #ee6e73;
      font-weight: 300;
  }
</style>

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
          <?php  echo $acees; ?>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <?php  echo $acees; ?>
      </ul>
  </div>
</nav>

<div class="container">
  <div class="row">
     <div class="col s12 " ng-view>
     </div>
  </div>
</div>



</body>
</html>