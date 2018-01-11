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
      <!--	<script src="<?= asset('../assetsm/js/materialize.min.js') ?>"></script>
      	<link href="<?= asset('../assetsm/css/materialize.min.css') ?>" rel="stylesheet">-->
       <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<!--Angular-->
	<script src="<?= asset('../app/angular/angular.min.js') ?>"></script>
	<script src="<?= asset('../app/angular/angular-route.min.js') ?>"></script>
		
    <!--Upload angular-->
      <script src="<?= asset('../js/ng-file-upload-shim.min.js') ?>"></script>
      <script src="<?= asset('../js/ng-file-upload.min.js') ?>"></script>
  <!--Aplicacion-->
	<script src="<?= asset('../app/app/appm.js') ?>"></script>
		<!--Controller-->
	<script src="<?= asset('../app/app/login/Start.js') ?>"></script>		

<style type="text/css">
 /* body { 
    background: url(https://i.pinimg.com/originals/bd/6c/f8/bd6cf8fd2c1f11c84d455051518923d4.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }*/
</style>

</head>
<body ng-controller="Login" >



  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->


 <div id="login-page" class="row" style="padding: 10%;">
    
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" name="logi_system" id="logi_system"  novalidate="">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="" alt="" class="circle responsive-img valign profile-image-login">
            <p class="center login-form-text">{{Name_Company}}</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="username" type="text" name="username" id="username"  ng-model="username" ng-required="true">
            <label for="username" >Username</label>
          </div>
          <span class="help-block error" ng-show="logi_system.username.$invalid && logi_system.username.$touched">El usuario es requerido</span>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix"> lock_outline </i>
            <input id="password" type="password" name="password" id="password" ng-model="password" ng-required="true">
            <label for="password">Password</label>
          </div>
          <span class="help-block error" ng-show="logi_system.password.$invalid && logi_system.password.$touched">El password es requerido</span>
        </div>
       	
       	<div class="row margin" ng-hide="Mensaje_Start=='' " ng-show=" Mensaje_Start!='' ">
       		<div class="col s12">
       			<div class="card red lighten-4">
		            <div class="card-content black-text waves-light center-align ">
		            	{{Mensaje_Start}}
		            </div>
		        </div>

       		</div>
       	</div>

        <div class="row">
          <div class="input-field col s12">
            <button type="button" ng-click="start_login();" ng-disabled="logi_system.$invalid" class="btn waves-effect pulse  waves-light col s12 " > Login </button>
          </div>
        </div>

      </form>
    </div>
  </div>



</body>
</html>