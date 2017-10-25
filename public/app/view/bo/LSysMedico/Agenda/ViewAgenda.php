
<div class="row" ng-init="permisos_user();" ng-cloak>

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


	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}}</strong></h3>
			<hr>
		</div>
	</div>

	<div >
		<div class="row" ng-hide=""  >
			<div class="col-md-1 col-xs-6" >
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Acciones <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li ng-hide=" list_permisos.access_excell==0 " ng-click="excell_cargo();" ><a href=""><i class="glyphicon glyphicon-th"></i> Excell</a></li>
				    <li role="separator" class="divider"></li>
				    <li ng-hide=" list_permisos.access_print==0 " ><a href="#"><i class="glyphicon glyphicon-print"></i> Imprimir</a></li>
				  </ul>
				</div>
			</div>
			<div class="col-md-5 col-xs-12" style="padding: 0;">
				<div class="btn-group"  >
					<button type="button" ng-click="back_calendar();" class="btn btn-primary btn-sm">
							<i class="glyphicon glyphicon-backward "></i> Atras
					</button>
					
					<button type="button" ng-click="nex_calendar();" class="btn btn-primary btn-sm">
							<i class="glyphicon glyphicon-forward "></i> Adelante
					</button>

					<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('Y');" id="btn_year">
						<i class="glyphicon glyphicon-calendar "></i> Año
					</button>
					<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('M');" id="btn_mes">
						<i class="glyphicon glyphicon-calendar "></i> Mes
					</button>
					<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('S');" id="btn_semana">
						<i class="glyphicon glyphicon-calendar "></i> Semana
					</button>
					<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('D');" id="btn_dia">
						<i class="glyphicon glyphicon-calendar "></i> Dia
					</button>

					<button type="button" class="btn btn-primary btn-sm" ng-click=" tipo_calendar='AG'; ">
						<i class="glyphicon glyphicon-plus "></i> Agendar
					</button>

					
				</div>
			</div>

			<!--<div class="col-md-2 col-xs-12">
				<div class="input-group ">
					<span class="btn btn-sm input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar "></i>  </span>
					<input type="text" class="form-control input-sm" name="descripcion" id="nombre" ng-model="descripcion" required />
					<span class="input-group-btn">
			        	<button class="btn btn-default btn-sm" type="button"><i class="glyphicon glyphicon-search"></i></button>
			      	</span>
				</div>
			</div>-->

			<div class="col-md-6 col-xs-12">
				
					<div class="input-group ">
						<span class="btn btn-sm input-group-addon">
							<i class="glyphicon glyphicon-calendar "></i> Desde 
						</span>
						<input type="text" class="form-control input-sm datepicker" name="fecha_desde" id="fecha_desde" ng-model="fecha_desde" required />
						
						<span class="btn btn-sm input-group-addon">
							<i class="glyphicon glyphicon-calendar "></i> Hasta 
						</span>
						<input type="text" class="form-control input-sm datepicker" name="fecha_hasta" id="fecha_hasta" ng-model="fecha_hasta" required />
						
						<span class="input-group-btn">
				        	<button class="btn btn-info btn-sm" ng-click="control_panel3();" type="button"><i class="glyphicon glyphicon-search"></i></button>
				      	</span>

				      	<select class="form-control input-sm " name="empleadoagenda" id="empleadoagenda" ng-model="empleadoagenda">
							<option value="">Seleccione</option>
							<option ng-repeat=" e in list_empleados0 " value="{{e.id_emp}}">
								{{e.persona.apellido+" "+e.persona.nombre+" || "+ ((e.cargo.id_carg!==null || e.cargo.id_carg!==undefined)? e.cargo.descripcion:'SIN CARGO') }}
							</option>
						</select>
					</div>
					
				</div>
			</div>

		</div>




		<div class="row" id="mes" ng-hide=" tipo_calendar!='M' ">
			<div class="col-md-12 col-xs-12 table-responsive">
				<table class="table table-bordered table-condensend">
					<thead>
						<tr class="bg-primary">
							<th colspan="7" class="text-center">{{Fecha_Select}}</th>
						</tr>
						<tr class="bg-primary">
							<th style="">Domingo</th>
							<th style="">Lunes</th>
							<th style="">Martes</th>
							<th style="">Miercoles</th>
							<th style="">Jueves</th>
							<th style="">Viernes</th>
							<th style="">Sabado</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="m in mes">
							<td ng-repeat="d in m" style="height: 130px !important;">
								<div class="row">
									<div class="col-xs-6">
										<button ng-hide=" d.Numero_Citas=='' "  ng-click="info_citas_dia(d);" class="btn btn-sm btn-success"><span class="badge" >{{d.Numero_Citas}}</span></button>
									</div>
									<div class="col-xs-6 text-right " ng-hide="d.Hoy!=0 "  >
										{{d.Numero_dia}}
									</div>

									<div class="col-xs-6 text-center " ng-hide="d.Hoy==0 "  >
										<div style="width: 30px; height: 30px; background-color:#81d4fa; border-radius: 50%; float: right;">
											{{d.Numero_dia}}
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>



		<div ng-hide=" tipo_calendar!='AG' " >
		<form class="form-horizontal"  name="frm_agenda" id="frm_agenda"  novalidate="">	
			<div class="row">
				<div class=" col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"> <i class="glyphicon glyphicon-list"></i> Tipo Agenda: </span>
						<select class="form-control" ng-change="make_time();"  name="tipoagenda" id="tipoagenda" ng-model="tipoagenda" required>
							<option value="1">Normal</option>
							<option value="2">Emergencia</option>
						</select>
					</div>
					<span class="help-block error" ng-show="frm_agenda.tipoagenda.$invalid && frm_agenda.tipoagenda.$touched">El tipo de ageanda es requerido</span>
				</div>
				<div class=" col-md-6 col-xs-12">
					<div class="input-group ">
						<span class="btn btn-sm input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user "></i> Empleado </span>
						<input type="text" class="form-control input-sm" readonly name="nombreempleado" id="nombreempleado" ng-model="nombreempleado" required />
						<span class="input-group-btn">
				        	<button class="btn btn-danger btn-sm" type="button" ng-click="limpiar_empleado();">
				        		<i class="glyphicon glyphicon-trash"></i>
				        	</button>
				        	<button class="btn btn-default btn-sm" type="button" ng-click="buscar_empleado()">
				        		<i class="glyphicon glyphicon-search"></i>
				        	</button>
				      	</span>
					</div>

					<span class="help-block error" ng-show="frm_agenda.nombreempleado.$invalid && frm_agenda.nombreempleado.$touched">El Empleado es requerido</span>
				</div>
				
			</div>


			<div class="row">
				<div class=" col-md-6 col-xs-12">
					<div class="input-group ">
						<span class="btn btn-sm input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user "></i> Cliente </span>
						<input type="text" class="form-control input-sm" readonly name="nombrecliente" id="nombrecliente" ng-model="nombrecliente" required />
						<span class="input-group-btn">
				        	<button class="btn btn-danger btn-sm" type="button" ng-click="limpiar_cliente();">
				        		<i class="glyphicon glyphicon-trash"></i>
				        	</button>
				        	<button class="btn btn-default btn-sm" type="button" ng-click="buscar_cliente();">
				        		<i class="glyphicon glyphicon-search"></i>
				        	</button>
				      	</span>
					</div>
					<span class="help-block error" ng-show="frm_agenda.nombrecliente.$invalid && frm_agenda.nombrecliente.$touched">El Cliente es requerido</span>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"> <i class="glyphicon glyphicon-calendar"></i> Fecha Cita: </span>
						<input type="text" class="form-control input-sm datepicker ng-pristine ng-valid ng-empty ng-touched" name="fechacita" id="fechacita" ng-model="fechacita" required>
					</div>
					<span class="help-block error" ng-show="frm_agenda.fechacita.$invalid && frm_agenda.fechacita.$touched">La fecha es requerida</span>
				</div>
				
			</div>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"> <i class="glyphicon glyphicon-time"></i> Hora Cita: </span>
						<select class="form-control"  name="hora" id="hora" ng-model="hora" required>
							<option value="">Seleccione</option>
							<option ng-repeat=" t in horas_general" value="{{t}}">{{t}}</option>
						</select>
					</div>
				<span class="help-block error" ng-show="frm_agenda.hora.$invalid && frm_agenda.hora.$touched">La hora es requerida</span>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"> <i class="glyphicon glyphicon-comment"></i> Observacion: </span>
						<input type="text" class="form-control input-sm " name="observacion" id="observacion" ng-model="observacion">
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-12 col-xs-12 text-center ">
					<div class="btn-group ">
						<button class="btn btn-success btn-sm" type="button" ng-click="save_agenda();" ng-disabled=" frm_agenda.$invalid ">
							<i class="glyphicon glyphicon-calendar"></i>
							Agendar
						</button>

						<button class="btn btn-default btn-sm" type="button" ng-click="clear_agenda(); control_panel('M'); " >
							<i class="glyphicon glyphicon-ban-circle"></i>
							Cancelar
						</button>	
					</div>
					

				</div>
			</div>
		</form>
		</div>



	</div>










<div class="modal fade" id="citas" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Información </h4>
      </div>
      <div class="modal-body">
        

      	<div class="row">
      		<div class="col-xs-12 table-responsive">
      			<table class="table table-bordered table-condensend">
      				<thead>
      					<tr class="bg-primary">
      						<th></th>
      						<th>Empleado</th>
      						<th>Cliente</th>
      						<th>Usuario</th>
      						<th>Fecha</th>
      						<th>Hora</th>
      						<th>Turno</th>
      						<th>Descripción</th>
      						<th>Estado</th>
      					</tr>
      				</thead>
      				<tbody>
      					<tr ng-repeat=" ci in list_info_day " style="font-size: 11px !important;">
      						<td>{{$index+1}}</td>
      						<td>{{ci.empleado.persona.apellido+' '+ci.empleado.persona.nombre}}</td>
      						<td>{{ci.cliente.persona.apellido+' '+ci.cliente.persona.nombre}}</td>
      						<td>{{ci.usuario.persona.apellido+' '+ci.usuario.persona.nombre}}</td>
      						<td>{{ci.fecha}}</td>
      						<td>{{ci.horainicio}}</td>
      						<td>{{ci.turno}}</td>
      						<td>{{ci.observacion}}</td>
      						<td>{{ci.gestion}}</td>
      					</tr>
      				</tbody>
      			</table>
      		</div>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" tabindex="-1" id="md_medico" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Buscar Empleado</h4>
      </div>
      <div class="modal-body">
        
      	<div class="row">
      		<div class="col-xs-6 col-md-6">
      			<div class="input-group">
			      <input type="text" class="form-control input-sm" placeholder="Buscar " name="buscartexto_empleado" ng-model="buscartexto_empleado" id="buscartexto_empleado">
			      <span class="input-group-btn">
			        <button class="btn btn-default btn-sm" type="button">Buscar</button>
			      </span>
			    </div>
      		</div>
      	</div>

      	<div class="row">
      		<div class="col-md-12 col-xs-12 table-responsive">
      			<table class="table table-condensend table-bordered">
      				<thead>
      					<tr class="bg-primary"> 
      						<th></th>
      						<th>Empleado</th>
      						<th>Cargo</th>
      						<th></th>
      					</tr>
      				</thead>
      				<tbody>
      					<tr dir-paginate="u in list_empleados | orderBy:sortKey:reverse |filter:buscartexto_empleado| itemsPerPage:5" total-items="totalItems" ng-cloak">
							<td>{{$index+1}}</td>
							<td>{{u.persona.apellido+" "+u.persona.nombre}}</td>
							<td>{{(u.cargo.id_carg!==null || u.cargo.id_carg!==undefined)? u.cargo.descripcion:'SIN CARGO';}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button  ng-click="select_empleado(u);" type="button" title="Editar" class="btn btn-sm btn-info">
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
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" id="md_cliente" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Buscar Cliente</h4>
      </div>
      <div class="modal-body">
        
      	<div class="row">
      		<div class="col-xs-6 col-md-6">
      			<div class="input-group">
			      <input type="text" class="form-control input-sm" placeholder="Buscar " name="buscartexto_cliente" ng-model="buscartexto_cliente" id="buscartexto_cliente">
			      <span class="input-group-btn">
			        <button class="btn btn-default btn-sm" type="button">Buscar</button>
			      </span>
			    </div>
      		</div>
      	</div>

      	<div class="row">
      		<div class="col-md-12 col-xs-12 table-responsive">
      			<table class="table table-condensend table-bordered">
      				<thead>
      					<tr class="bg-primary"> 
      						<th></th>
      						<th>DNI</th>
      						<th># Historia</th>
      						<th>Cliente</th>
      						<th>Edad</th>
      						<th>Direccion</th>
      						<th></th>
      					</tr>
      				</thead>
      				<tbody style="font-size: 11px;">
						<tr dir-paginate="u in list_cliente | orderBy:sortKey:reverse |filter:buscartexto_cliente| itemsPerPage:5" total-items="totalItems" ng-cloak">
							<td>{{$index+1}}</td>
							<td>{{u.persona.ci}}</td>
							<td>{{u.numerohistoria}}</td>
							<td>{{u.persona.apellido+" "+u.persona.nombre}}</td>
							<td>{{u.persona.edad}}</td>
							<td>{{u.persona.direccion}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button  ng-click="select_cliente(u);" type="button" title="Editar" class="btn btn-sm btn-info">
										<i class="glyphicon glyphicon-edit"></i>
									</button>
								</div>
							</td>
						</tr>
      				</tbody>
      			</table>
      			<dir-pagination-controls
		        	on-page-change="pageChanged_cliente(newPageNumber)"
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
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
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