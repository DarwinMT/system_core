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
	body { 
    background: url(https://www.ten-x.com/company/blog/wp-content/uploads/sites/4/2017/03/computer-1149148_1280.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
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
		 	background-color: #fff;
		    /* shadows and rounded borders */
		    -moz-border-radius: 2px;
		    -webkit-border-radius: 2px;
		    border-radius: 2px;
		    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

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
	</style>	
</head>
<body ng-controller="Login" ng-cloak>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">{{Name_Company}}</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal"  name="logi_system" id="logi_system"  novalidate="">
						
						

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
</body>
</html>