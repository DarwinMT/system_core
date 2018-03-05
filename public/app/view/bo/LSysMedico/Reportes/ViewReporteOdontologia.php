<div class="row" ng-init="permisos_user();" ng-cloak>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>


	<!--Registro pais-->
	<div ng-hide=" newedid!='0' " ng-show=" newedid=='0' " >

		<div class="row">
			<!--<div class="col-md-1 col-xs-6">
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
			</div>-->

			<div class="col-md-4 col-xs-6">
				<div class="input-group ">
					<span class="btn btn-sm input-group-addon">
						<i class="glyphicon glyphicon-user "></i> Buscar Cliente 
					</span>
					<div class="form-group has-feedback">
					    <input type="text" class="form-control input-sm" id="buscartexto" name="buscartexto" ng-model="buscartexto" ng-keyup="initLoad(1)" placeholder="Buscar Cliente">
					    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>

			</div>


			<!--<div class="col-md-3 col-xs-6">
				<div class="input-group ">
					<span class="btn btn-sm input-group-addon">
						<i class="glyphicon glyphicon-calendar "></i> Desde 
					</span>
					<input type="text" class="form-control input-sm datepicker" name="fecha_desde" id="fecha_desde" ng-model="fecha_desde" required />
				</div>
			</div>

			<div class="col-md-3 col-xs-6">
				<div class="input-group ">
					<span class="btn btn-sm input-group-addon">
						<i class="glyphicon glyphicon-calendar "></i> Hasta 
					</span>
					<input type="text" class="form-control input-sm datepicker" name="fecha_hasta" id="fecha_hasta" ng-model="fecha_hasta" required />
				</div>
			</div>-->

			

			<div class="col-md-1 col-xs-6">
				<button type="button" ng-click="initLoad(1);" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search" ></i></button>
			</div>
			
		</div>


		<div class="row">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend" >
					<thead class="bg-primary">
						<tr>
							<th></th>
							<th>Cliente</th>
							<th>CI | # Historia Cli.</th>
							<th>Edad</th>
							<th>Dirección</th>
							<th>Correo</th>
							<th>Historial</th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="r in list_Historia | orderBy:sortKey:reverse |filter:buscartexto| itemsPerPage:5" total-items="totalItems" ng-cloak>
							<td>{{$index+1}}</td>
							<td>{{r.cliente.persona.apellido+' '+r.cliente.persona.nombre}}</td>
							<td>{{r.cliente.persona.ci+' | '+r.cliente.numerohistoria}}</td>
							<td>{{calcular_edad(r.cliente.persona.fechan)}}</td>
							<td>{{r.cliente.persona.direccion}}</td>
							<td>{{r.cliente.persona.email}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button ng-disabled="" ng-click="init_see(r);" type="button" title="Ver Historia Clinica" class="btn btn-sm btn-default">
										<i class="glyphicon glyphicon-list-alt"></i>
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
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<h3><strong>{{aux_Historia.cliente.persona.apellido+' '+aux_Historia.cliente.persona.nombre+' | '+aux_Historia.cliente.persona.ci +' | '+aux_Historia.cliente.numerohistoria+' | '+calcular_edad(aux_Historia.cliente.persona.fechan)}} |  <button class="btn btn-primary btn-sm " ng-click=" newedid='0'; initLoad(1); "><i class="glyphicon glyphicon-list-alt"></i>  Registro</button></strong></h3>
				<hr/>
			</div>
		</div>

		<div class="row">

			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend" >
					<thead class="bg-primary">
						<tr>
							<th colspan="9" class="text-center">Cita->Anamnesis</th>
						</tr>
						<tr>
							<th></th>
							<th>Empleado</th>
							<th>Empresa</th>
							<th>Fecha Y Hora Consulta</th>
							<th>Motivo</th>
							<th>Estado</th>
							<th>Tipo</th>
							<th>Odontograma</th>
							<th>Receta</th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="r in list_anamnesiscliente | itemsPerPage:5" total-items="totalItemsanamnesis" ng-cloak>
							<td>{{$index+1}}</td>
							<td>{{r.empleado.persona.apellido+' '+r.empleado.persona.nombre}}</td>
							<td>{{r.empresa.nombre}}</td>
							<td>{{r.fecha+' | '+r.horainicio}}</td>
							
							<td>{{r.consultageneral[0].motivo}}</td>

							<td ng-hide="r.gestion==1 " style="background-color: #009688;">{{((r.gestion==1)?"PENDIENTE":"FINALIZADA")}}</td>
      						<td ng-hide="r.gestion!=1 " style="background-color: #bbdefb; ">{{((r.gestion==1)?"PENDIENTE":"FINALIZADA")}}</td>


      						<td ng-hide="r.tipo==1 " style="background-color: #f44336 ">{{((r.tipo==1)?"NORMAL":"EMERRGENCIA")}}</td>
      						<td ng-hide="r.tipo!=1 " style="background-color: #80cbc4 ">{{((r.tipo==1)?"NORMAL":"EMERRGENCIA")}}</td>

							<td>
								<div class="btn-group" role="group" >
									<button ng-disabled="" ng-click="print_odontograma(r);" type="button" title="Imprimir Odontograma" class="btn btn-sm btn-default">
										<i class="glyphicon glyphicon-print"></i>
									</button>
								</div>
							</td>
							<td>
								<div class="btn-group" role="group" >
									<button ng-disabled="" ng-click="print_receta(r);" type="button" title="Imprimir Receta" class="btn btn-sm btn-default">
										<i class="glyphicon glyphicon-print"></i>
									</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<dir-pagination-controls
		        	on-page-change="pageChanged_anamnesis(newPageNumber)"
		            template-url="dirPagination.html"
		            class="pull-right"
		            max-size="10"
		            direction-links="true"
		            boundary-links="true" >
		        </dir-pagination-controls>
			</div>

		</div>



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

	<div class="modal fade"  id="WPrint" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header btn-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="WPrint_head"></h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12" id="bodyprint">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <i class="glyphicon glyphicon glyphicon-ban-circle"></i> </button>
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