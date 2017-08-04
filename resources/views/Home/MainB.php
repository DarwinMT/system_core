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


<style>
  .dropdown-submenu {
      position: relative;
  }
  .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
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
          <ul class="nav navbar-nav">
            
            <li class="active  dropdown">
              <a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                Sistema
                <span class="caret"></span> 
              </a>
              <ul class="dropdown-menu" > 
                <li><a href="#">Empresa</a></li> 
              </ul>
            </li>

            <li class="active  dropdown">
              <a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                Configuracion
                <span class="caret"></span> 
              </a>
              <ul class="dropdown-menu" > 
                <li><a href="#">Pais</a></li> 
                <li><a href="#">Provincia</a></li> 
                <li><a href="#">Ciudad</a></li> 
              </ul>
            </li>


            <li class="dropdown">
              <a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                Administracion
                <span class="caret"></span> 
                <ul class="dropdown-menu" > 
                  <li class="dropdown-submenu" >
                    <a href="#" class="test" tabindex="-1" >
                      Cliente (Paciente) 
                      <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                      <li><a tabindex="-1" href="#">Registro Cliente (Paciente)</a></li>
                      <li><a tabindex="-1" href="#">Anamnesis Cliente (Paciente)  </a></li>
                      <li><a tabindex="-1" href="#">Historial Cliente (Paciente) </a></li>
                    </ul>

                  </li>

                  <li class="dropdown-submenu">
                    <a href="#" class="test" tabindex="-1">
                      Empleado (Personal Medico)
                      <span class="caret"></span>
                        <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Registro Empleado (Personal Medico)</a></li>
                          <li class="divider"></li>
                          <li><a tabindex="-1" href="#">Registro Cliente (Paciente)</a></li>
                          <li><a tabindex="-1" href="#">Anamnesis Cliente (Paciente) </a></li>
                          <li><a tabindex="-1" href="#">Historial Cliente (Paciente)</a></li>
                          <li><a tabindex="-1" href="#">Citas (Agenda)</a></li>
                          <li><a tabindex="-1" href="#">Historial Citas</a></li>
                        </ul>
                    </a>
                  </li> 


                  <li class="dropdown-submenu" >
                    <a href="#" class="test" tabindex="-1" >
                      Proveedor
                      <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                      <li><a tabindex="-1" href="#">Registro </a></li>
                    </ul>

                  </li>

                  
                </ul>
              </a>
            </li>
            <li><a href="#contact">Contact </a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right"> 
          <li  class="dropdown "> 
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