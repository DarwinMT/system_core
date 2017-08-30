<div class="row" ng-init="permisos_user(); rol();" ng-cloak>
	
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}}</strong></h3>
			<hr>
		</div>
	</div>

	<!--Registro-->
	<div ng-hide=" newedit!='0' " ng-show=" newedit=='0' " >

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
				<button ng-disabled=" list_permisos.access_ready==0 " type="button" class="btn btn-sm btn-primary" ng-click=" newedit='1'; ">
					<i class="glyphicon glyphicon-plus"></i> Nuevo Si Datos
				</button>
			</div>
			<div class="col-md-2 col-xs-6">
				<button ng-disabled=" list_permisos.access_ready==0 " type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Nuevo Con Datos</button>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend" >
					<thead class="bg-primary">
						<tr>
							<th></th>
							<th>Dni</th>
							<th>Proveedor</th>
							<th>Razón Social</th>
							<th>Dirección</th>
							<th>Telefono</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="u in list_proveedor | orderBy:sortKey:reverse |filter:buscartexto| itemsPerPage:5" total-items="totalItems" ng-cloak">
							<td>{{$index+1}}</td>
							<td>{{u.persona.ci}}</td>
							<td>{{u.persona.apellido+" "+u.persona.nombre}}</td>
							<td>{{u.razonsocial}}</td>
							<td>{{u.persona.direccion}}</td>
							<td>{{u.telefonoprincipal}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button ng-disabled=" list_permisos.access_edit==0 " ng-click="init_edit(u);" type="button" title="Editar" class="btn btn-sm btn-info">
										<i class="glyphicon glyphicon-edit"></i>
									</button>
									<button ng-disabled=" list_permisos.access_delete==0 " ng-click="int_estado(u);" type="button" title="Activar/Inactivar" class="btn btn-sm btn-danger">
										<i class="glyphicon glyphicon-trash"></i>
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
	<div ng-hide=" newedit!='1' ||  newedit!='2' "  ng-show=" newedit=='1' ||  newedit=='2' ">
	<form class="form-horizontal"  name="proveedor_system" id="proveedor_system"  novalidate="">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group" id="vista_dni_new">
					<span class="input-group-addon" id="basic-addon1">DNI: </span>
					<input type="text" class="form-control input-sm" name="ci" id="ci" ng-model="ci" ng-keyup="valida_dni();" />
				</div>
				<span class="help-block error" ng-show=" valida_dninew!=0 ">Este Dni ya existe</span>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="input-group" id="vista_dni_new">
					<span class="input-group-addon" id="basic-addon1">Razon Social: </span>
					<input type="text" class="form-control input-sm" name="razonsocial" id="razonsocial" ng-model="razonsocial" ng-keyup="" />
				</div>
				
			</div>


		</div>

		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nombre: </span>
					<input type="text" class="form-control input-sm" name="nombre" id="nombre" ng-model="nombre" required />
				</div>
				<span class="help-block error" ng-show="proveedor_system.nombre.$invalid && proveedor_system.nombre.$touched">El nombre es requerido</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Apellido: </span>
					<input type="text" class="form-control input-sm" name="apellido" id="apellido" ng-model="apellido" required />
				</div>
				<span class="help-block error" ng-show="proveedor_system.apellido.$invalid && proveedor_system.apellido.$touched">El apellido es requerido</span>
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
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Telefono : </span>
					<input type="text" class="form-control input-sm" name="telefonoprincipal" id="telefonoprincipal" ng-model="telefonoprincipal" />
				</div>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Avatar: </span>
					<input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
				</div>
				<span class="help-block error" ng-show="proveedor_system.file.$error.pattern">El archivo debe ser Imagen</span>
				<span class="help-block error" ng-show="proveedor_system.file.$error.maxSize">El tamaño máximo es de 2 MB </span>
			</div>
		</div>

		<div class="row">
			
			<div class="col-md-6 col-xs-6">
				<div class="col-xs-6 text-center" style="margin-top: 5px;">
                    <img class="img-thumbnail" ngf-src="file || url_foto"  alt="" style="width: 50%;">
                </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" role="group" aria-label="...">
					<button ng-hide=" newedit!='1' "  ng-show=" newedit=='1' "  ng-disabled=" list_permisos.access_save==0 || proveedor_system.$invalid ||  valida_dninew!=0 " type="button" class="btn btn-sm btn-success" ng-click=" save(); ">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button ng-click="edit();" ng-hide=" newedit!='2' "  ng-show=" newedit=='2' " ng-disabled=" list_permisos.access_edit==0 || user_system_edit.$invalid || valida_dninew!=0" type="button" class="btn btn-sm btn-info">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>


					<button type="button" class="btn btn-sm btn-primary" ng-click=" newedit='0'; clear();">
						<i class="glyphicon glyphicon-list"></i> Registro
					</button>
				</div>
			</div>
		</div>
	</form>
	</div>
	<!--Nuevo Usuario Sin datos-->


	
	<!--Permisos-->
	<div ng-hide=" newedit!='3' "  ng-show=" newedit=='3' " >
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

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newedit='0'; ">
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

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newedit='0'; ">
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