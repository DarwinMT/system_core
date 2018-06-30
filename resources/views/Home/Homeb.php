<!DOCTYPE html>
<html lang="en" ng-app="System_Core">
<head>
	<title>Athan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="ATHAN es un sistema médico vía web orientado a los médicos  para mejorar la calidad y atención a los pacientes mediante la utilización de la tecnología." />
	<meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Jquery-->
    <script src="<?= asset('../js/jquery-3.1.1.min.js') ?>"></script>


    <!--Bootstrap 3-->
	<script src="<?= asset('../assetsb/js/bootstrap.min.js') ?>"></script>
	<link href="<?= asset('../assetsb/css/bootstrap.min.css') ?>" rel="stylesheet">

	<!--Angular-->
	<script src="<?= asset('../app/angular/angular.min.js') ?>"></script>
	<script src="<?= asset('../app/angular/angular-route.min.js') ?>"></script>
		<!--Paginacion angular-->
    	<script src="<?= asset('../js/dirPagination.js') ?>"></script>
    	<!--Upload angular-->
    	<script src="<?= asset('../js/ng-file-upload-shim.min.js') ?>"></script>
    	<script src="<?= asset('../js/ng-file-upload.min.js') ?>"></script>
		<!--Aplicacion-->
	<script src="<?= asset('../app/app/app.js') ?>"></script>
		<!--Controller-->
	<script src="<?= asset('../app/app/login/Start.js') ?>"></script>

	<!--Style  https://bootsnipp.com/snippets/featured/register-page -->
	<style type="text/css">
	/*-----------*/
		html {
		    height: 100%;
		    overflow-y: hidden;
		}
		body {
		    background-image: url('https://ugc.kn3.net/i/origin/http://i.blogs.es/830e5d/computer-1149148_960_720/1366_2000.jpg');
		    background-position: 50%;
		    background-repeat: no-repeat;
		    background-size: cover;
		    height: 100%;
		}
		.navbar {
		   background-color:  rgba(34, 34, 34,0.7);
		   background:        rgba(34, 34, 34,0.7);
		   border-color:      rgba(34, 34, 34,0.7);
		}
		footer {
		    position: fixed;
		    height: 15px !important;
		    bottom: 0;
		    width: 100%;
		    color: white;
		    font-size: 11px;
		    background-color:  rgba(34, 34, 34,0.7);
		    background:        rgba(34, 34, 34,0.7);
		    
		}
		/*-----------*/
		.main{
		 	margin-top: 70px;
		}

		h1.title { 
			font-size: 50px;
			font-weight: 400; 
		}

		hr{
			width: 10%;
			color: #fff;
		}

		.form-group{
			margin-bottom: 15px;
		}

		label{
			margin-bottom: 15px;
		}

		input,
		input::-webkit-input-placeholder {
		    font-size: 11px;
		    padding-top: 3px;
		}

		.main-login{
		 	/*background-color: #fff;*/
		 	background-color: rgba(254,254,253,0.9);
		    /* shadows and rounded borders */
		    -moz-border-radius: 4px;
		    -webkit-border-radius: 4px;
		    border-radius: 4px;
		    -moz-box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.5);
		    -webkit-box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.5);
		    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.5);

		}

		.main-center{
		 	margin-top: 30px;
		 	margin: 0 auto;
		 	max-width: 330px;
		    padding: 40px 40px;

		}

		.login-button{
			margin-top: 5px;
		}

		.login-register{
			font-size: 11px;
			text-align: center;
		}
		.informacion{
			background-color:  rgba(34, 34, 34,0.5) !important;
		   	background:        rgba(34, 34, 34,0.5) !important;
		   	border-color:      rgba(34, 34, 34,0.5) !important;
		   	color: white;
		}
	</style>

	<script type="text/javascript">
		var imagenes=[
		    "https://ugc.kn3.net/i/origin/http://i.blogs.es/830e5d/computer-1149148_960_720/1366_2000.jpg",
		    "http://www.meedicina.com/wp-content/uploads/2015/07/Medicina-personalizada.jpg",
		    "http://quoblog.quodem.com/wp-content/uploads/2017/08/medicos-tecnologia.jpg",
		    "https://www.gannett-cdn.com/-mm-/a2fcac9168983e24bc93f9429436a562fac717fb/c=0-52-1000-614&r=x803&c=1600x800/local/-/media/Ithaca/2014/11/07/shutterstock131496734.jpg",];
	    function change_background(){

	      var pos=Math.floor((Math.random() * imagenes.length) + 1);
	      $("body").css("background-image","url("+imagenes[pos-1]+")").fadeIn("slow");
	      setTimeout(function(){
	        change_background();
	      },2000);
	    }
		change_background();
	</script>	
</head>
<body ng-controller="Login" ng-cloak>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">Athan</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class=""><a href="">Inicicio</a></li>
        <li><a href="">Acerca De Nosotros</a></li>
        <li><a href="">Contactos</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>	
		<div class="container">
			<div class="row main">
				
				<div class="col-md-4 col-xs-12">
					<!--<div class="panel informacion">
					  <div class="panel-body">

					  </div>
					</div>-->
				</div>
				<div class="col-md-4 col-xs-12"></div>

				<div class="col-md-4 col-xs-12">
					<!--<div class="panel-heading">
		               <div class="panel-title text-center">
		               		<h1 class="title">{{Name_Company}}</h1>
		               		<hr />
		               	</div>
		            </div> -->
					<div class="main-login main-center">
						<form class="form-horizontal"  name="logi_system" id="logi_system"  novalidate="">
							
							<div class=""><h1 class="title">{{Name_Company}}</h1></div>

							<div class="form-group">
								<label for="username" class="cols-sm-2 control-label">Username</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
										<input type="text" class="form-control" name="username" id="username" ng-model="username" ng-required="true"  placeholder="Username"/>
									</div>

									 <span class="help-block error" ng-show="logi_system.username.$invalid && logi_system.username.$touched">El usuario es requerido</span>

								</div>
							</div>

							<div class="form-group">
								<label for="password" class="cols-sm-2 control-label">Password</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
										<input type="password" class="form-control" name="password" id="password" ng-model="password" ng-required="true"  placeholder="Password"/>
									</div>
									<span class="help-block error" ng-show="logi_system.password.$invalid && logi_system.password.$touched">El password es requerido</span>
								</div>
							</div>

							<div class="form-group" ng-hide="Mensaje_Start=='' " ng-show=" Mensaje_Start!='' " >
								<div class="alert alert-warning text-center" role="alert">
									{{Mensaje_Start}}
								</div>
							</div>


							<div class="form-group ">
								<button type="button" ng-click="start_login();" ng-disabled="logi_system.$invalid" class="btn btn-primary btn-lg btn-block login-button">Login</button>
							</div>
						
						</form>
					</div>
				</div>


			</div>
		</div>


<footer class="navbar-fixed-bottom">
    <div class="row">
      <div class="col-md-4 col-xs-12 text-left">
        © Todos los derechos reservados
      </div>
      <div class="col-md-4 col-xs-12 text-center">
        
      </div>
      <div class="col-md-4 col-xs-12 text-right">
        Athan V. 0.1.0  (SystemCore)
      </div>
    </div>
</footer>		
</body>
</html>