<div class="row" ng-init="permisos_user(); rol();" ng-cloak>
	
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
				    <li ng-hide=" list_permisos.access_excell==0 " ng-click="excell_user();" ><a href=""><i class="glyphicon glyphicon-th"></i> Excell</a></li>
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
				<button ng-disabled=" list_permisos.access_ready==0 " ng-click="init_listemple();" type="button" class="btn btn-sm btn-primary">
                    <i class="glyphicon glyphicon-plus"></i> Nuevo Con Datos
                </button>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend" >
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
									<button ng-disabled=" list_permisos.access_edit==0 " ng-click="init_edit(u);" type="button" title="Editar" class="btn btn-sm btn-info">
										<i class="glyphicon glyphicon-edit"></i>
									</button>
									<button ng-disabled=" list_permisos.access_delete==0 " ng-click="int_estado(u);" type="button" title="Activar/Inactivar" class="btn btn-sm btn-danger">
										<i class="glyphicon glyphicon-trash"></i>
									</button>
									<button ng-disabled=" list_permisos.access_ready==0 " ng-click="init_permisos(u);" type="button" title="Permisos" class="btn btn-sm btn-warning">
										<i class="glyphicon glyphicon-cog"></i>
									</button>
									<button ng-disabled=" list_permisos.access_ready==0 " ng-click="init_chage_user(u);" type="button" title="Cambio De Clave" class="btn btn-sm btn-primary">
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

	<!--Registro Excell-->
	<div style="display: none;">
		<table id="list_user">
			<thead>
				<tr class="bg-primary">
					<th></th>
					<th>Rol</th>
					<th>Usuario</th>
					<th>CI</th>
					<th>Apellido</th>
					<th>Nombre</th>
					<th>Direccion</th>
					<th>Correo</th>
					<th>Fecha N.</th>
					<th>Genero</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="e in list_user_excell">
					<td>{{$index+1}}</td>
					<td>{{ (e.permisos[0].rol!=undefined)? e.permisos[0].rol.descripcion:"No Asignado"; }}</td>
					<td>{{e.username}}</td>
					<td>{{e.persona.ci}}</td>
					<td>{{e.persona.apellido}}</td>
					<td>{{e.persona.nombre}}</td>
					<td>{{e.persona.direccion}}</td>
					<td>{{e.persona.email}}</td>
					<td>{{e.persona.fechan}}</td>
					<td>{{e.persona.genero}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!--Registro Excell-->

	<!--Nuevo  Usuario Sin datos-->
	<div ng-hide=" newusersin!='1' "  ng-show=" newusersin=='1' ">
	<form class="form-horizontal"  name="user_system" id="user_system"  novalidate="">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group" id="vista_dni_new">
					<span class="input-group-addon" id="basic-addon1">DNI: </span>
					<input type="text" class="form-control input-sm" name="ci" id="ci" ng-model="ci" ng-keyup="valida_user_dni();" />
				</div>
				<span class="help-block error" ng-show=" valida_dninew!=0 ">Este Dni ya existe</span>
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
					<input type="email" class="form-control input-sm" name="email" id="email" ng-model="email" />
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 1%;">
			<div class="col-md-6 col-xs-6" >
				<div class="input-group" id="vista_user_new">
					<span class="input-group-addon" id="basic-addon1">Usuario: </span>
					<input type="text" class="form-control input-sm" name="username" id="username" ng-model="username" ng-keyup="valida_user_new()" required />
				</div>
				<span class="help-block error" ng-show="user_system.username.$invalid && user_system.username.$touched">El usuario es requerido</span>
				<span class="help-block error" ng-show=" valida_usernew!=0 ">El usuario ya existe</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Avatar: </span>
					<input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
				</div>
				<span class="help-block error" ng-show="user_system.file.$error.pattern">El archivo debe ser Imagen</span>
				<span class="help-block error" ng-show="user_system.file.$error.maxSize">El tamaño máximo es de 2 MB </span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6" >
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Clave: </span>
					<input type="password" class="form-control input-sm" name="password" id="password" ng-model="password" required />
				</div>
				<span class="help-block error" ng-show="user_system.password.$invalid && user_system.password.$touched">La clave es requerida</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="col-xs-6 text-center" style="margin-top: 5px;">
                    <img class="img-thumbnail" ngf-src="file || url_foto"  alt="" style="width: 50%;">
                </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" role="group" aria-label="...">
					<button ng-hide=" newusersin!='1' "  ng-show=" newusersin=='1' "  ng-disabled=" list_permisos.access_save==0 || user_system.$invalid || valida_usernew!=0 || valida_dninew!=0 " type="button" class="btn btn-sm btn-success" ng-click=" save(); ">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newusersin='0'; clear();">
						<i class="glyphicon glyphicon-list"></i> Registro
					</button>
				</div>
			</div>
		</div>
	</form>
	</div>
	<!--Nuevo Usuario Sin datos-->

	<!--Editar Usuario Sin datos-->

	<div ng-hide=" newusersin!='2' "  ng-show=" newusersin=='2' ">
	<form class="form-horizontal"  name="user_system_edit" id="user_system_edit"  novalidate="">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group" id="vista_dni_edit">
					<span class="input-group-addon" id="basic-addon1">DNI: </span>
					<input type="text" class="form-control input-sm" name="ci_edit" id="ci_edit" ng-model="ci_edit" ng-keyup="valida_user_dni_edit()" />
				</div>
				<span class="help-block error" ng-show=" valida_dniedit!=0 ">Este Dni ya existe</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nombre: </span>
					<input type="text" class="form-control input-sm" name="nombre_edit" id="nombre_edit" ng-model="nombre_edit" required />
				</div>
				<span class="help-block error" ng-show="user_system_edit.nombre_edit.$invalid && user_system_edit.nombre_edit.$touched">El nombre es requerido</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Apellido: </span>
					<input type="text" class="form-control input-sm" name="apellido_edit" id="apellido_edit" ng-model="apellido_edit" required />
				</div>
				<span class="help-block error" ng-show="user_system_edit.apellido_edit.$invalid && user_system_edit.apellido_edit.$touched">El apellido es requerido</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Genero: </span>
					<select class="form-control input-sm" name="genero_edit" id="genero_edit" ng-model="genero_edit">
						<option value="">Seleccione</option>
						<option value="M">Masculino</option>
						<option value="F">Femenino</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Fecha N.: </span>
					<input type="text" class="form-control input-sm datepicker" name="fechan_edit" id="fechan_edit" ng-model="fechan_edit" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Dirección: </span>
					<input type="text" class="form-control input-sm" name="direccion_edit" id="direccion_edit" ng-model="direccion_edit" />
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Email: </span>
					<input type="text" class="form-control input-sm" name="email_edit" id="email_edit" ng-model="email_edit" />
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 1%;">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Avatar: </span>
					<input class="form-control" type="file" ngf-select ng-model="file_edit" name="file_edit" id="file_edit" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
				</div>
				<span class="help-block error" ng-show="user_system_edit.file_edit.$error.pattern">El archivo debe ser Imagen</span>
				<span class="help-block error" ng-show="user_system_edit.file_edit.$error.maxSize">El tamaño máximo es de 2 MB </span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="col-xs-6 text-center" style="margin-top: 5px;">
                    <img class="img-thumbnail" ngf-src="file_edit || url_foto "  alt="" style="width: 50%;">
                </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" role="group" >
					<button ng-click="edit();" ng-hide=" newusersin!='2' "  ng-show=" newusersin=='2' " ng-disabled=" list_permisos.access_edit==0 || user_system_edit.$invalid || valida_dniedit!=0" type="button" class="btn btn-sm btn-info">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newusersin='0'; ">
						<i class="glyphicon glyphicon-list"></i> Registro
					</button>
				</div>
			</div>
		</div>
	</form>
	</div>

	<!--Editar Usuario Sin datos-->
	
	<!--Permisos-->
	<div ng-hide=" newusersin!='3' "  ng-show=" newusersin=='3' " >
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<strong>Seleccione los permisos para el usuario: {{aux_user_access.username}}</strong>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Rol: </span>
					<select class="form-control input-sm" name="id_r" id="id_r" ng-model="id_r">
						<option value="">Seleccione </option>
						<option ng-repeat=" r in list_rol "  value="{{r.id_r}}">{{r.descripcion}}</option>
					</select>
				</div>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="btn-group" role="group" aria-label="...">
					<button ng-hide="  "  ng-show="  "  ng-disabled=" list_permisos.access_save==0 " type="button" class="btn btn-sm btn-success" ng-click=" save_permisos(); ">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newusersin='0'; ">
						<i class="glyphicon glyphicon-list"></i> Registro
					</button>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table ng-repeat=" np in menu " class="table table-bordered table-condensend">
					<thead class="bg-primary">
						<tr>
							<th></th>
							<th >{{np.Nodo.titulo}}</th>
							<th>Leer</th>
							<th>Guardar</th>
							<th>Editar</th>
							<th>Delete</th>
							<th>Imprimir</th>
							<th>Excell</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat=" ni in np.Nodos ">
							<td>{{$index+1}}</td>
							<td>{{ni.titulo}}</td>
							<td> <input type="checkbox" name="" ng-model="ni.access_ready" ></td>
							<td> <input type="checkbox" name="" ng-model="ni.access_save" ></td>
							<td> <input type="checkbox" name="" ng-model="ni.access_edit" ></td>
							<td> <input type="checkbox" name="" ng-model="ni.access_delete" ></td>
							<td> <input type="checkbox" name="" ng-model="ni.access_print" ></td>
							<td> <input type="checkbox" name="" ng-model="ni.access_excell" ></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" role="group" aria-label="...">
					<button ng-hide="  "  ng-show="  "  ng-disabled=" list_permisos.access_save==0 " type="button" class="btn btn-sm btn-success" ng-click=" save_permisos(); ">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newusersin='0'; ">
						<i class="glyphicon glyphicon-list"></i> Registro
					</button>
				</div>
			</div>
		</div>

	</div>
	<!--Permisos-->

<div class="modal fade" id="modal_userpass" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Usuario Y Contraseña</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        		<div class="input-group" id="vista_user_edit">
				  <span class="input-group-addon" id="basic-addon1">Usuario</span>
				  <input type="text" class="form-control input-sm" name="aux_username" id="aux_username" ng-model="aux_username" ng-keyup="valida_user_edit()" >
				</div>
        	</div>
        	<div class="col-md-12 col-xs-12">
        		<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Clave</span>
				  <input type="password" class="form-control input-sm" name="aux_password" id="aux_password" ng-model="aux_password">
				</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
        <button ng-click="edit_userpass();" ng-disabled=" list_permisos.access_edit==0 || result_valida_user!=0 " type="button" class="btn btn-sm btn-info">
			<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
		</button>
      </div>
    </div>
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


    <div class="modal fade" id="listempleado" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header btn-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lista De Empleados</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control input-sm" id="buscartextoempleado" name="buscartextoempleado" ng-model="buscartextoempleado" ng-keyup="initLoad_empleado(1)" placeholder="Buscar Empleado">
                                <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Estado</span>
                                <select class="form-control input-sm" id="estadoanuladoempleado" name="estadoanuladoempleado" ng-model="estadoanuladoempleado" ng-change="initLoad_empleado(1);">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1 col-xs-4">
                            <button type="button" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search" ng-click="initLoad_empleado(1);"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12 table-responsive">
                            <table class="table table-bordered table-condensend" >
                                <thead class="bg-primary">
                                <tr>
                                    <th></th>
                                    <th>Dni</th>
                                    <th>Empleado</th>
                                    <th>Cargo</th>
                                    <th>Dirección</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr dir-paginate="u in list_empleados | orderBy:sortKey:reverse |filter:buscartexto| itemsPerPage:5" total-items="totalItems" ng-cloak">
                                <td>{{$index+1}}</td>
                                <td>{{u.persona.ci}}</td>
                                <td>{{u.persona.apellido+" "+u.persona.nombre}}</td>
                                <td>{{(u.cargo.id_carg!==null || u.cargo.id_carg!==undefined)? u.cargo.descripcion:'SIN CARGO';}}</td>
                                <td>{{u.persona.direccion}}</td>
                                <td>
                                    <div class="btn-group" role="group" >
                                        <button  ng-click="select_empleado(u);" type="button" title="Seleccionar" class="btn btn-sm btn-info">
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                        </button>
                                    </div>
                                </td>
                                </tr>
                                </tbody>
                            </table>

                            <dir-pagination-controls
                                    on-page-change="pageChanged_empleado(newPageNumber)"
                                    template-url="dirPagination.html"
                                    class="pull-right"
                                    max-size="10"
                                    direction-links="true"
                                    boundary-links="true" >
                            </dir-pagination-controls>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmuserempl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmación</h4>
                </div>
                <div class="modal-body">
                    <h4>
                        <strong>Esta seguro de agregar este empleado como usuario?</strong>
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        Cancelar
                    </button>
                    <button type="button" ng-click="confir_user_emp();" class="btn btn-primary">
                        <i class="glyphicon glyphicon-ok"></i>
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="modalestado" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmación</h4>
      </div>
      <div class="modal-body">
        	<strong>{{Msm_estado}}</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
        <button type="button" class="btn btn-primary" ng-click="update_estado();" ><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
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