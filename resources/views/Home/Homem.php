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
    footer {
        position: fixed;
        /*height: 15px !important;*/
        bottom: 0;
        width: 100%;
    }
    .card-panel{
      background: rgba(254,254,254,0.9) !important;
    }
    #login-page{
      margin-right: auto;
      margin-left: auto;
      display:block; 
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
<body ng-controller="Login" >



  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->


 <div id="login-page" class="row center-align" style="padding: 5%;">
    
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" name="logi_system" id="logi_system"  novalidate="">
        <div class="row ">
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
            <button type="button" ng-click="start_login();" ng-disabled="logi_system.$invalid" class="btn waves-effect   waves-light col s12 " > Login </button>
          </div>
        </div>

      </form>
    </div>
  </div>




<footer class="page-footer">

  <div class="footer-copyright">
    <div class="container">
      
    <div class="row">
      <div class="col s12 m6 center-align">
        © Todos los derechos reservados
      </div>
      <div class="col s12 m6 center-align">
        Athan V. 0.1.0  (SystemCore)
      </div>
    </div>
  </div>
</footer>

</body>
</html>