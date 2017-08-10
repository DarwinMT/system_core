<div class="row" ng-init="permisos_user();" ng-cloak>
	
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}}</strong></h3>
			<hr>
		</div>
	</div>

	<!--Registro-->
	<div ng-hide=" newusersin!='0' " ng-show=" newusersin=='0' " >

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
				    <input type="text" class="form-control input-sm" id="buscartexto" name="buscartexto" ng-model="buscartexto" ng-keyup="initLoad(1)" placeholder="Buscar Usuario">
				    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>

			<div class="col-md-2 col-xs-6">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Estado</span>
				  <select class="form-control input-sm" id="estadoanulado" name="estadoanulado" ng-model="estadoanulado" ng-change="initLoad(1);">
				  	<option value="1">Activo</option>
				  	<option value="0">Inactivo</option>
				  </select>
				</div>
			</div>

			<div class="col-md-1 col-xs-6">
				<button type="button" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search" ng-click="initLoad(1);"></i></button>
			</div>
			<div class="col-md-2 col-xs-6">
				<button ng-disabled=" list_permisos.access_ready==0 " type="button" class="btn btn-sm btn-primary" ng-click=" newusersin='1'; ">
					<i class="glyphicon glyphicon-plus"></i> Nuevo Si Datos
				</button>
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
							<th>Rol</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="u in list_usuario | orderBy:sortKey:reverse |filter:buscartexto| itemsPerPage:5" total-items="totalItems" ng-cloak">
							<td>{{$index+1}}</td>
							<td>{{ (u.permisos[0].rol!=undefined)? u.permisos[0].rol.descripcion:"No Asignado"; }}</td>
							<td>{{u.username}}</td>
							<td>{{u.persona.apellido+" "+u.persona.nombre}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button ng-disabled=" list_permisos.access_edit==0 " type="button" title="Editar" class="btn btn-sm btn-info">
										<i class="glyphicon glyphicon-edit"></i>
									</button>
									<button ng-disabled=" list_permisos.access_delete==0 " type="button" title="Activar/Inactivar" class="btn btn-sm btn-danger">
										<i class="glyphicon glyphicon-trash"></i>
									</button>
									<button ng-disabled=" list_permisos.access_ready==0 " type="button" title="Permisos" class="btn btn-sm btn-warning">
										<i class="glyphicon glyphicon-lock"></i>
									</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<dir-pagination-controls
		        	on-page-change="pageChanged(newPageNumber)"
		            template-url="dirPagination.html"
		            class="pull-right"
		            max-size="10"
		            direction-links="true"
		            boundary-links="true" >
		        </dir-pagination-controls>
			</div>
		</div>

	</div>
	<!--Registro-->

	<!--Nuevo  Usuario Sin datos-->
	<div ng-hide=" newusersin!='1' "  ng-show=" newusersin=='1' ">
	<form class="form-horizontal"  name="user_system" id="user_system"  novalidate="">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">DNI: </span>
					<input type="text" class="form-control input-sm" name="ci" id="ci" ng-model="ci" />
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
					<select class="form-control input-sm" name="genero" id="genero" ng-model="genero">
						<option value="">Seleccione</option>
						<option value="M">Masculino</option>
						<option value="F">Femenino</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Fecha N.: </span>
					<input type="text" class="form-control input-sm datepicker" name="fechan" id="fechan" ng-model="fechan" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Dirección: </span>
					<input type="text" class="form-control input-sm" name="direccion" id="direccion" ng-model="direccion" />
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Email: </span>
					<input type="text" class="form-control input-sm" name="email" id="email" ng-model="email" />
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
				<button ng-hide=" newusersin!='1' "  ng-show=" newusersin=='1' "  ng-disabled=" list_permisos.access_save==0 || user_system.$invalid" type="button" class="btn btn-sm btn-success" ng-click=" save(); ">
					<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
				</button>
				
				<button ng-hide=" newusersin!='2' "  ng-show=" newusersin=='2' " ng-disabled=" list_permisos.access_edit==0 || user_system.$invalid" type="button" class="btn btn-sm btn-info">
					<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
				</button>

				<button type="button" class="btn btn-sm btn-primary" ng-click=" newusersin='0'; ">
					<i class="glyphicon glyphicon-list"></i> Registro
				</button>
			</div>
		</div>
	</form>
	</div>
	<!--Nuevo Usuario Sin datos-->
	




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