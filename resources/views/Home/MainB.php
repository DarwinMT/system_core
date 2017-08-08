<!DOCTYPE html>
<html lang="en" ng-app="System_Core">
<head>
	<title>Inicio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Jquery-->
    <script src="<?= asset('../js/jquery-3.1.1.min.js') ?>"></script>


    <!--Bootstrap 3-->
	<script src="<?= asset('../assetsb/js/bootstrap.min.js') ?>"></script>
	<link href="<?= asset('../assetsb/css/bootstrap.min.css') ?>" rel="stylesheet">

	<!--Angular-->
	<script src="<?= asset('../app/angular/angular.min.js') ?>"></script>
	<script src="<?= asset('../app/angular/angular-route.min.js') ?>"></script>
		<!--Aplicacion-->
	<script src="<?= asset('../app/app/app.js') ?>"></script>

  <script src="<?= asset('../app/app/Usuario/UsuarioController.js') ?>"></script>
		<!--Controller-->


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