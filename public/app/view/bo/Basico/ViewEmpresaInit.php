<div class="row" ng-init="permisos_user();" ng-cloak>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>

	<div class="row">
		<form class="form-horizontal"  name="frmemp" id="frmemp"  novalidate="">
			<div class="row">
				<div class="col-md-12 col-xs-12 text-center">
					<div class="btn-group" >
						<button type="button" class="btn btn-success btn-sm" ng-disabled=" frmemp.$invalid " ng-click="edit()">
							<i class="glyphicon glyphicon-floppy-saved"></i>
							Guardar
						</button>
					</div>
				</div>
			</div>

		<div class="panel panel-primary">
		  <div class="panel-heading">Crear Empresa</div>
		  <div class="panel-body">
		    
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"> Nombre</span>
					  <input type="text" class="form-control input-sm" id="nombre_emp" name="nombre_emp" ng-model="nombre_emp" required />
					</div>
					<span class="help-block error" ng-show="frmemp.nombre_emp.$invalid && frmemp.nombre_emp.$touched">El nombres es requerido</span>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"> RUC</span>
					  <input type="text" class="form-control input-sm" id="ruc" name="ruc" ng-model="ruc" />
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"> País</span>
					  <select  class="form-control input-sm" id="id_pa" name="id_pa" ng-model="id_pa"  required >
					  		<option value="">Seleccione</option>
					  		<option ng-repeat=" p in list_pais " value="{{p.id_pa}}">{{p.descripcion}}</option>
					  </select>
					</div>
					<span class="help-block error" ng-show="frmemp.id_pa.$invalid && frmemp.id_pa.$touched">El pais es requerido</span>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"> Provincia</span>
					  <select  class="form-control input-sm" id="id_pro" name="id_pro" ng-model="id_pro"  ng-change="loadcioudad(id_pro,'');"  required >
					  		<option value="">Seleccione</option>
					  		<option ng-repeat=" p in list_provincia " value="{{p.id_pro}}">{{p.descripcion}}</option>
					  </select>
					</div>
					<span class="help-block error" ng-show="frmemp.id_pro.$invalid && frmemp.id_pro.$touched">La provincia es requerida</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"> Ciudad</span>
					  <select  class="form-control input-sm" id="id_ci" name="id_ci" ng-model="id_ci"  required >
					  		<option value="">Seleccione</option>
					  		<option ng-repeat=" c in list_ciudad " value="{{c.id_ci}}">{{c.descripcion}}</option>
					  </select>
					</div>
					<span class="help-block error" ng-show="frmemp.id_ci.$invalid && frmemp.id_ci.$touched">La ciudad es requerida</span>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"> Dirección</span>
					  <input type="text" class="form-control input-sm" id="direccion_emp" name="direccion_emp" ng-model="direccion_emp" required />
					</div>
					<span class="help-block error" ng-show="frmemp.direccion_emp.$invalid && frmemp.direccion_emp.$touched">La dirección es requerida</span>
				</div>

			</div>

			<div class="row" >
				<div class="col-md-6 col-xs-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Teléfono : </span>
						<input type="text" class="form-control input-sm" name="telefono" id="telefono" ng-model="telefono" required />
					</div>
					<span class="help-block error" ng-show="frmemp.telefono.$invalid && frmemp.telefono.$touched">El teléfono es requerido</span>
				</div>

				<div class="col-md-6 col-xs-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Logo: </span>
						<input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
					</div>
					<span class="help-block error" ng-show="frmemp.file.$error.pattern">El archivo debe ser Imagen</span>
					<span class="help-block error" ng-show="frmemp.file.$error.maxSize">El tamaño máximo es de 2 MB </span>

					<img class="img-thumbnail" ngf-src="file || url_foto"  alt="" style="width: 50%;">
				</div>
			</div>

			
		
		  </div>
		</div>
		
		<div class="panel panel-primary">
		  <div class="panel-heading">Confiuracion Empresa</div>
		  <div class="panel-body">
		    
		  	<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group" id="">
							<span class="input-group-addon" id="basic-addon1">Hora Inicio Agenda: </span>
							<input type="text" class="form-control input-sm" name="horai" id="horai" ng-model="horai" required />
					</div>
					<span class="help-block error" ng-show="frmemp.horai.$invalid && frmemp.horai.$touched">La hora de inicio es requerida</span>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="input-group" id="">
							<span class="input-group-addon" id="basic-addon1">Hora Fin Agenda: </span>
							<input type="text" class="form-control input-sm" name="horaf" id="horaf" ng-model="horaf" required />
					</div>
					<span class="help-block error" ng-show="frmemp.horaf.$invalid && frmemp.horaf.$touched">La hora final es requerida</span>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group" id="">
							<span class="input-group-addon" id="basic-addon1">Intervalo  Agenda: </span>
							<input type="text" class="form-control input-sm" name="intervalo" id="intervalo" ng-model="intervalo" required />
					</div>
					<span class="help-block error" ng-show="frmemp.intervalo.$invalid && frmemp.intervalo.$touched">El intervalo es requerido</span>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="input-group" id="">
							<span class="input-group-addon" id="basic-addon1">Ver Clientes : </span>
							<select class="form-control input-sm"  name="allclientes" id="allclientes" ng-model="allclientes" required>
								<option value="1">Propios</option>
								<option value="0">Todos Del Sistema</option>
							</select>
					</div>
					<span class="help-block error" ng-show="frmemp.allclientes.$invalid && frmemp.allclientes.$touched">El estado cliente es requerido</span>
				</div>
			
			</div>

			
			
			

		  </div>
		</div>



		<div class="panel panel-primary">
		  <div class="panel-heading">Crear Usuario</div>
		  <div class="panel-body">
		    <div class="row">
				<div class="col-md-6 col-xs-12">
				<div class="input-group" id="vista_dni_new">
							<span class="input-group-addon" id="basic-addon1">DNI: </span>
							<input type="text" class="form-control input-sm" name="ci" id="ci" ng-model="ci" ng-keyup="valida_user_dni();" />
						</div>
						<span class="help-block error" ng-show=" valida_dninew!=0 ">Este Dni ya existe</span>
						<span class="help-block error" ng-show="frmemp.ci.$invalid && frmemp.ci.$touched">El Dni es requerido</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Nombre: </span>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre" ng-model="nombre" required />
					</div>
					<span class="help-block error" ng-show="frmemp.nombre.$invalid && frmemp.nombre.$touched">El nombre es requerido</span>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Apellido: </span>
						<input type="text" class="form-control input-sm" name="apellido" id="apellido" ng-model="apellido" required />
					</div>
					<span class="help-block error" ng-show="frmemp.apellido.$invalid && frmemp.apellido.$touched">El apellido es requerido</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Genero: </span>
						<select class="form-control input-sm" name="genero" id="genero" ng-model="genero">
							<option value="">Seleccione</option>
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Fecha N.: </span>
						<input type="text" class="form-control input-sm datepicker" name="fechan" id="fechan" ng-model="fechan" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Dirección: </span>
						<input type="text" class="form-control input-sm" name="direccion" id="direccion" ng-model="direccion" />
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Email: </span>
						<input type="email" class="form-control input-sm" name="email" id="email" ng-model="email" />
					</div>
				</div>
			</div>

			<div class="row" style="padding-top: 1%;">
				<div class="col-md-6 col-xs-12" >
					<div class="input-group" id="vista_user_new">
						<span class="input-group-addon" id="basic-addon1">Usuario: </span>
						<input type="text" class="form-control input-sm" name="username" id="username" ng-model="username" ng-keyup="valida_user_new()" required />
					</div>
					<span class="help-block error" ng-show="frmemp.username.$invalid && frmemp.username.$touched">El usuario es requerido</span>
					<span class="help-block error" ng-show=" valida_usernew!=0 ">El usuario ya existe</span>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Avatar: </span>
						<input class="form-control" type="file" ngf-select ng-model="avatar" name="avatar" id="avatar" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
					</div>
					<span class="help-block error" ng-show="frmemp.avatar.$error.pattern">El archivo debe ser Imagen</span>
					<span class="help-block error" ng-show="frmemp.avatar.$error.maxSize">El tamaño máximo es de 2 MB </span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12" >
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Clave: </span>
						<input type="password" class="form-control input-sm" name="password" id="password" ng-model="password" required />
					</div>
					<span class="help-block error" ng-show="frmemp.password.$invalid && frmemp.password.$touched">La clave es requerida</span>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="col-xs-6 text-center" style="margin-top: 5px;">
	                    <img class="img-thumbnail" ngf-src="avatar || url_fotoavatar"  alt="" style="width: 50%;">
	                </div>
				</div>
			</div>

		  </div>
		</div>


		

		</form>	
	</div>

<div class="modal fade" id="sms" style="z-index: 5000;" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div id="titulomsm" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!--<h4 class="modal-title">Modal title</h4>-->
      </div>
      <div class="modal-body">
        <h5><strong id="smsb"></strong></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="progress" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="progress">
		  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		    <span class="">Procesando la transacción</span>
		  </div>
		</div>
      </div>
  </div>
</div>

</div>