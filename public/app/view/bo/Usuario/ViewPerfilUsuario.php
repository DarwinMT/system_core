<div class="row" ng-init="permisos_user();" ng-cloak>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-xs-12">
		<form class="form-horizontal"  name="frmemp" id="frmemp"  novalidate="">
			
		<div class="panel panel-primary">
		  <div class="panel-heading">Datos Principales</div>
		  <div class="panel-body">
		    <div class="row">
				<div class="col-md-6 col-xs-12">
				<div class="input-group" id="vista_dni_edit">
							<span class="input-group-addon" id="basic-addon1">DNI: </span>
							<input type="text" class="form-control input-sm" name="ci_edit" id="ci_edit" ng-model="ci_edit" ng-keyup="valida_user_dni_edit();" />
						</div>
						<span class="help-block error" ng-show=" valida_dniedit!=0 ">Este Dni ya existe</span>
						<span class="help-block error" ng-show="frmemp.ci_edit.$invalid && frmemp.ci_edit.$touched">El Dni es requerido</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Nombre: </span>
						<input type="text" class="form-control input-sm" name="nombre_edit" id="nombre_edit" ng-model="nombre_edit" required />
					</div>
					<span class="help-block error" ng-show="frmemp.nombre_edit.$invalid && frmemp.nombre_edit.$touched">El nombre es requerido</span>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Apellido: </span>
						<input type="text" class="form-control input-sm" name="apellido_edit" id="apellido_edit" ng-model="apellido_edit" required />
					</div>
					<span class="help-block error" ng-show="frmemp.apellido_edit.$invalid && frmemp.apellido_edit.$touched">El apellido es requerido</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Genero: </span>
						<select class="form-control input-sm" name="genero_edit" id="genero_edit" ng-model="genero_edit">
							<option value="">Seleccione</option>
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Fecha N.: </span>
						<input type="text" class="form-control input-sm datepicker" name="fechan_edit" id="fechan_edit" ng-model="fechan_edit" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Dirección: </span>
						<input type="text" class="form-control input-sm" name="direccion_edit" id="direccion_edit" ng-model="direccion_edit" />
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Email: </span>
						<input type="email_edit" class="form-control input-sm" name="email_edit" id="email_edit" ng-model="email_edit" />
					</div>
				</div>
			</div>

			<div class="row" >
				
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Avatar: </span>
						<input class="form-control" type="file" ngf-select ng-model="file_edit" name="file_edit" id="file_edit" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
					</div>
					<span class="help-block error" ng-show="frmemp.file_edit.$error.pattern">El archivo debe ser Imagen</span>
					<span class="help-block error" ng-show="frmemp.file_edit.$error.maxSize">El tamaño máximo es de 2 MB </span>
				</div>
			</div>

			<div class="row">
				
				<div class="col-md-6 col-xs-12">
					<div class="col-xs-6 text-center" >
	                    <img class="img-thumbnail" ngf-src="file_edit || url_foto"  alt="" style="width: 70%;">
	                </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-xs-12 text-center">
					<div class="btn-group" >
						<button type="button" class="btn btn-primary btn-sm" ng-disabled=" frmemp.$invalid || valida_dniedit!=0 " ng-click="edit()">
							<i class="glyphicon glyphicon-floppy-saved"></i>
							Guardar
						</button>
					</div>
				</div>
			</div>
		  </div>
		</div>
		</form>	
		</div>

		<div class="col-md-6 col-xs-12">
			<form class="form-horizontal"  name="frmuser" id="frmuser"  novalidate="">
			<div class="panel panel-primary">
			  <div class="panel-heading">Datos Usuario</div>
			  <div class="panel-body">
			    <div class="row">
			    	<div class="col-md-6 col-xs-12" >
						<div class="input-group" id="vista_user_edit">
							<span class="input-group-addon" id="basic-addon1">Usuario: </span>
							<input type="text" class="form-control input-sm" name="aux_username" id="aux_username" ng-model="aux_username" ng-keyup="valida_user_edit()" required />
						</div>
						<span class="help-block error" ng-show="frmuser.aux_username.$invalid && frmuser.aux_username.$touched">El usuario es requerido</span>
						<span class="help-block error" ng-show=" valida_usernew!=0 ">El usuario ya existe</span>
					</div>

					<div class="col-md-6 col-xs-12" >
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Clave: </span>
							<input type="password" class="form-control input-sm" name="aux_password" id="aux_password" ng-model="aux_password" required />
						</div>
						<span class="help-block error" ng-show="frmuser.aux_password.$invalid && frmuser.aux_password.$touched">La clave es requerida</span>
					</div>
			    </div>

			    <div class="row">
			    	<div class="col-xs-12 col-md-12 text-center">
			    		<button type="button" class="btn btn-primary btn-sm" ng-disabled=" frmuser.$invalid || result_valida_user!=0 " ng-click="edit_userpass()" >
			    			<i class="glyphicon glyphicon-floppy-saved"></i>
							Guardar
			    		</button>
			    	</div>
			    </div>

			  </div>
			</div>
			</form>
		</div>
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