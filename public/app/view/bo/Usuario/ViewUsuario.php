<div class="row" ng-init="permisos_user();" ng-cloak>
	<!--Registro-->
	<div >
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}}</strong></h3>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-1 col-xs-6">
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Acciones <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li ng-hide=" list_permisos.access_excell==0 " ><a href="#"><i class="glyphicon glyphicon-th"></i> Excell</a></li>
				    <li role="separator" class="divider"></li>
				    <li ng-hide=" list_permisos.access_print==0 " ><a href="#"><i class="glyphicon glyphicon-print"></i> Imprimir</a></li>
				  </ul>
				</div>
			</div>

			<div class="col-md-4 col-xs-6">
				<div class="form-group has-feedback">
				    <input type="text" class="form-control input-sm" id="">
				    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>

			<div class="col-md-2 col-xs-6">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Estado</span>
				  <select class="form-control input-sm" >
				  </select>
				</div>
			</div>

			<div class="col-md-1 col-xs-6">
				<button type="button" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search"></i></button>
			</div>
			<div class="col-md-2 col-xs-6">
				<button ng-disabled=" list_permisos.access_ready==0 " type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Nuevo Si Datos</button>
			</div>
			<div class="col-md-2 col-xs-6">
				<button ng-disabled=" list_permisos.access_ready==0 " type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Nuevo Con Datos</button>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend">
					<thead class="bg-primary">
						<tr>
							<th></th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>light</td>
							<td>Darwin Tarapuez</td>
							<td>
								<button ng-disabled=" list_permisos.access_edit==0 " type="button" title="Editar" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></button>
								<button ng-disabled=" list_permisos.access_delete==0 " type="button" title="Activar/Inactivar" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
								<button ng-disabled=" list_permisos.access_ready==0 " type="button" title="Permisos" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-lock"></i></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<!--Registro-->

	<!--Nuevo  Usuario Sin datos-->
	<div>
	<form class="form-horizontal"  name="user_system" id="user_system"  novalidate="">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">DNI: </span>
					<input type="text" class="form-control input-sm" name="" id="" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nombre: </span>
					<input type="text" class="form-control input-sm" name="nombre" id="nombre" ng-model="nombre" required />
				</div>
				<span class="help-block error" ng-show="user_system.nombre.$invalid && user_system.nombre.$touched">El nombre es requerido</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Apellido: </span>
					<input type="text" class="form-control input-sm" name="apellido" id="apellido" ng-model="apellido" required />
				</div>
				<span class="help-block error" ng-show="user_system.apellido.$invalid && user_system.apellido.$touched">El apellido es requerido</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Genero: </span>
					<select class="form-control input-sm" name="" id="" >
						<option value="">Masculino</option>
						<option value="">Femenino</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Fecha N.: </span>
					<input type="text" class="form-control input-sm" name="" id="" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Dirección: </span>
					<input type="text" class="form-control input-sm" name="" id="" />
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Email: </span>
					<input type="text" class="form-control input-sm" name="" id="" />
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 1%;">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Usuario: </span>
					<input type="text" class="form-control input-sm" name="username" id="username" ng-model="username" required />
				</div>
				<span class="help-block error" ng-show="user_system.username.$invalid && user_system.username.$touched">El usuario es requerido</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Avatar: </span>
					<input type="text" class="form-control input-sm" name="" id="" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Clave: </span>
					<input type="password" class="form-control input-sm" name="password" id="password" ng-model="password" required />
				</div>
				<span class="help-block error" ng-show="user_system.password.$invalid && user_system.password.$touched">La clave es requerida</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<button ng-disabled=" list_permisos.access_save==0 || user_system.$invalid" type="button" class="btn btn-sm btn-success">
					<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
				</button>
				
				<button ng-disabled=" list_permisos.access_edit==0 || user_system.$invalid" type="button" class="btn btn-sm btn-info">
					<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
				</button>

				<button type="button" class="btn btn-sm btn-primary">
					<i class="glyphicon glyphicon-list"></i> Registro
				</button>
			</div>
		</div>
	</form>
	</div>
	<!--Nuevo Usuario Sin datos-->
	




</div>