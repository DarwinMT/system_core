<!DOCTYPE html>
<html lang="en">
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

	<!--Style  https://bootsnipp.com/snippets/featured/register-page -->
	<style type="text/css">
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
<body>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Company Name</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="#">
						
						

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>


						<div class="form-group ">
							<button type="button" class="btn btn-primary btn-lg btn-block login-button">Login</button>
						</div>
					
					</form>
				</div>
			</div>
		</div>
</body>
</html>