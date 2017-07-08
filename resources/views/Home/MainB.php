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
		<!--Controller-->

	
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
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact </a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right"> 
          <li id="fat-menu" class="dropdown "> 
          	<a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
          	 <i class="glyphicon glyphicon-user"></i> <?php echo " ".$data_user[0]->username; ?>
          	 <span class="caret"></span> 
          	</a> 
          		<ul class="dropdown-menu" aria-labelledby="drop3"> 
	          		<li><a href="">Perfil</a></li> 
	          		<li role="separator" class="divider"></li> 
	          		<li><a href="/logout_system">Salir</a></li> 
          		</ul> 
          	</li> 
          	</ul>
          
        </div>
    </div>
</nav>

</body>
</html>