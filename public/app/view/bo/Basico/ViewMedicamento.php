<div class="row" ng-init="permisos_user();" ng-cloak>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}}</strong></h3>
			<hr>
		</div>
	</div>

	<!--Registro pais-->
	<div ng-hide=" newedid!='0' " ng-show=" newedid=='0' " >

		<div class="row">
			<div class="col-md-1 col-xs-6">
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Acciones <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li ng-hide=" list_permisos.access_excell==0 " ng-click="excell_Vademecum();" ><a href=""><i class="glyphicon glyphicon-th"></i> Excell</a></li>
				    <li role="separator" class="divider"></li>
				    <li ng-hide=" list_permisos.access_print==0 " ><a href="#"><i class="glyphicon glyphicon-print"></i> Imprimir</a></li>
				  </ul>
				</div>
			</div>

			<div class="col-md-4 col-xs-6">
				<div class="form-group has-feedback">
				    <input type="text" class="form-control input-sm" id="buscartexto" name="buscartexto" ng-model="buscartexto" ng-keyup="initLoad(1)" placeholder="Buscar Medicamento">
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
				<button ng-disabled=" list_permisos.access_ready==0 " type="button" class="btn btn-sm btn-primary" ng-click=" newedid='1'; ">
					<i class="glyphicon glyphicon-plus"></i> Nuevo
				</button>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend" >
					<thead class="bg-primary">
						<tr>
							<th></th>
							<th>Descripción</th>
							<th>Presentación</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="r in list_vademecum | orderBy:sortKey:reverse |filter:buscartexto| itemsPerPage:5" total-items="totalItems" ng-cloak">
							<td>{{$index+1}}</td>
							<td>{{r.descripcion}}</td>
							<td>{{r.presentacion}}</td>
							<td>{{(r.estado==1)?"Activo":"Inactivo";}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button ng-disabled=" list_permisos.access_edit==0 " ng-click="init_edit(r);" type="button" title="Editar" class="btn btn-sm btn-info">
										<i class="glyphicon glyphicon-edit"></i>
									</button>
									<button ng-disabled=" list_permisos.access_delete==0 " ng-click="int_estado(r);" type="button" title="Activar/Inactivar" class="btn btn-sm btn-danger">
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
	<!--Registro pais-->

	<!--Registro Excell-->
	<div style="display: none;">
		<table id="list_country">
			<thead>
				<tr class="bg-primary">
					<th></th>
					<th>Descripción</th>
					<th>Presentación</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="e in list_vademecum_excell">
					<td>{{$index+1}}</td>
					<td>{{e.descripcion}}</td>
					<td>{{e.presentacion}}</td>
					<td>{{(e.estado==1)?"Activo":"Inactivo";}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!--Registro Excell-->

	<!--Nuevo  Usuario Sin datos-->
	<div ng-hide=" newedid!='1' ||  newedid!='2' "  ng-show=" newedid=='1' ||  newedid=='2' ">
	<form class="form-horizontal"  name="frmvademecum" id="frmvademecum"  novalidate="">
	
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Descriopción: </span>
					<input type="text" class="form-control input-sm" name="descripcion" id="descripcion" ng-model="descripcion" required />
				</div>
				<span class="help-block error" ng-show="frmvademecum.descripcion.$invalid && frmvademecum.descripcion.$touched">La descripción es requerido</span>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Presentación: </span>
					<input type="text" class="form-control input-sm" name="presentacion" id="presentacion" ng-model="presentacion" required />
				</div>
				<span class="help-block error" ng-show="frmvademecum.presentacion.$invalid && frmvademecum.presentacion.$touched">La presentación es requerido</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" role="group" aria-label="...">
					<button ng-hide=" newedid!='1' "  ng-show=" newedid=='1' "  ng-disabled=" list_permisos.access_save==0 || frmvademecum.$invalid  " type="button" class="btn btn-sm btn-success" ng-click=" save(); ">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button ng-hide=" newedid!='2' "  ng-show=" newedid=='2' "  ng-disabled=" list_permisos.access_edit==0 || frmvademecum.$invalid " type="button" class="btn btn-sm btn-info" ng-click=" edit(); ">
						<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
					</button>

					<button type="button" class="btn btn-sm btn-primary" ng-click=" newedid='0'; clear();">
						<i class="glyphicon glyphicon-list"></i> Registro
					</button>
				</div>
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