<style type="text/css">
	.caries{
		fill:rgb(255,0,0);
	}
	.obturado{
		fill:rgb(0,0,255);
	}
</style>
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
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>

	<div >

		<div class="row">

			<div class="col-md-3 col-xs-12">

				<div class="row">
					<div class="col-md-12 col-xs-6" >
						<div class="btn-group"  >
							<button type="button" ng-click="back_calendar();" class="btn btn-primary btn-sm">
									<i class="glyphicon glyphicon-backward "></i> Atras
							</button>
							
							<button type="button" ng-click="nex_calendar();" class="btn btn-primary btn-sm">
									<i class="glyphicon glyphicon-forward "></i> Adelante
							</button>

							<button type="button" class="btn btn-primary btn-sm" ng-click=" tipo_calendar='AG'; ">
								<i class="glyphicon glyphicon-plus "></i> Agendar
							</button>
						</div>
					</div>

					<div class="col-md-12 col-xs-6" >
						<div class="btn-group"  >
							<!--
							<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('Y');" id="btn_year">
								<i class="glyphicon glyphicon-calendar "></i> Año
							</button>-->
							<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('M');" id="btn_mes">
								<i class="glyphicon glyphicon-calendar "></i> Mes
							</button>
							<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('S');" id="btn_semana">
								<i class="glyphicon glyphicon-calendar "></i> Semana
							</button>
							<button type="button" class="btn btn-info btn-sm" ng-click="control_panel2('D');" id="btn_dia">
								<i class="glyphicon glyphicon-calendar "></i> Dia
							</button>

							<button class="btn btn-info btn-sm" ng-click="control_panel3();" type="button">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="input-group ">
							<span class="btn btn-sm input-group-addon">
								<i class="glyphicon glyphicon-calendar "></i> Desde 
							</span>
							<input type="text" class="form-control input-sm datepicker" name="fecha_desde" id="fecha_desde" ng-model="fecha_desde" required />
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="input-group ">
							<span class="btn btn-sm input-group-addon">
							<i class="glyphicon glyphicon-calendar "></i> Hasta 
							</span>
							<input type="text" class="form-control input-sm datepicker" name="fecha_hasta" id="fecha_hasta" ng-model="fecha_hasta" required />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="input-group ">
							<span class="btn btn-sm input-group-addon">
								<i class="glyphicon glyphicon-user "></i> Empleado 
							</span>
							<select class="form-control input-sm " disabled name="empleadoagenda" id="empleadoagenda" ng-model="empleadoagenda">
								<option value="">Seleccione</option>
								<option ng-repeat=" e in list_empleados0 " value="{{e.id_emp}}">
									{{e.persona.apellido+" "+e.persona.nombre+" || "+ ((e.cargo.id_carg!==null || e.cargo.id_carg!==undefined)? e.cargo.descripcion:'SIN CARGO') }}
								</option>
						</select>
						</div>
					</div>
				</div>
			</div>

			<!--work-->
			<div class="col-md-9 col-xs-12">

				<div class="row" ng-hide=" tipo_calendar=='CIT' || tipo_calendar=='DIAG' ">
					<div class="col-md-2 col-xs-6" >
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

					<div class="col-md-4 col-xs-6">
						<div class="form-group has-feedback">
						    <input type="text" class="form-control input-sm" id="buscartexto" name="buscartexto" ng-model="buscartexto" " placeholder="Buscar Cita">
						    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1">Estado</span>
						  <select class="form-control input-sm" id="estadoanuladoagenda" name="estadoanuladoagenda" ng-model="estadoanuladoagenda" ng-change="initLoad(1);">
						  	<option value="1">Activo</option>
						  	<option value="0">Inactivo</option>
						  </select>
						</div>
					</div>

					<div class="col-md-3 col-xs-12 " >
						<div class="btn-group"  >
							<button class="btn btn-default btn-sm" ng-click="control_panel3();" type="button">
								<i class="glyphicon glyphicon-search"></i>
							</button>
							<button type="button" class="btn btn-primary btn-sm" ng-click=" tipo_calendar='AG'; ">
								<i class="glyphicon glyphicon-plus "></i> Agendar
							</button>
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

											<div class="col-xs-6 text-center " ng-hide="d.Hoy==0 && !isNaN(d.Numero_dia) "  >
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


				<div class="row"  ng-hide=" tipo_calendar!='S' ">
					<div class="col-xs-12 table-responsive">
						<table class="table table-condensend table-bordered">
							<thead>
								<tr class="bg-primary">
									<th colspan="8" class="text-center">{{Fecha_Select}}</th>
								</tr>
								<tr class="bg-primary">
									<th style="">Tiempo</th>
									<th style="">Domingo  {{list_dias_citas_semana[0]}}</th>
									<th style="">Lunes    {{list_dias_citas_semana[1]}}</th>
									<th style="">Martes   {{list_dias_citas_semana[2]}}</th>
									<th style="">Miercoles {{list_dias_citas_semana[3]}} </th>
									<th style="">Jueves   {{list_dias_citas_semana[4]}}</th>
									<th style="">Viernes  {{list_dias_citas_semana[5]}}</th>
									<th style="">Sabado   {{list_dias_citas_semana[6]}}</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat=" w in list_citas_semana">
									<td ng-repeat=" dy in w " >
										<div class="row" >
											<div class="col-xs-6">
												<button ng-hide=" dy.Numero_Citas=='' || dy.time "  ng-click="info_citas_dia(dy);" class="btn btn-sm btn-success"><span class="badge" >{{dy.Numero_Citas}}</span></button>
											</div>
											
											<div class="col-xs-12" ng-hide=" !dy.time">
												{{dy.time}}
											</div>
										
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>


				<div class="row"  ng-hide=" tipo_calendar!='D' ">
					<div class="col-xs-12 table-responsive">
		      			<table class="table table-bordered table-condensend">
		      				<thead>
		      					<tr class="bg-primary">
		      						<th></th>
		      						<th>Empleado</th>
		      						<th>Cliente</th>
		      						<!--<th>Usuario</th>-->
		      						<th>CI. Cli.</th>
		      						<th>Fecha</th>
		      						<th>Hora</th>
		      						<th>Turno</th>
		      						<th>Descripción</th>
		      						<th>Estado</th>
		      						<th>Tipo</th>
		      						<th></th>
		      						<th></th>
		      					</tr>
		      				</thead>
		      				<tbody>
		      					<tr ng-repeat=" dg in list_agend_day |filter:buscartexto " style="font-size: 11px !important;">
		      						<td>{{$index+1}}</td>
		      						<td>{{dg.empleado.persona.apellido+' '+dg.empleado.persona.nombre}}</td>
		      						<td>{{dg.cliente.persona.apellido+' '+dg.cliente.persona.nombre}}</td>
		      						<!--<td>{{dg.usuario.persona.apellido+' '+dg.usuario.persona.nombre}}</td>-->
		      						<td>{{dg.cliente.persona.ci}}</td>
		      						<td>{{dg.fecha}}</td>
		      						<td>{{dg.horainicio}}</td>
		      						<td>{{dg.turno}}</td>
		      						<td>{{dg.observacion}}</td>
		      						<!--<td>{{dg.gestion}}</td>-->

		      						<td ng-hide="dg.gestion==1 " style="background-color: #009688;">{{((dg.gestion==1)?"PENDIENTE":"FINALIZADA")}}</td>
		      						<td ng-hide="dg.gestion!=1 " style="background-color: #bbdefb; ">{{((dg.gestion==1)?"PENDIENTE":"FINALIZADA")}}</td>


		      						<td ng-hide="dg.tipo==1 " style="background-color: #f44336 ">{{((dg.tipo==1)?"NORMAL":"EMERRGENCIA")}}</td>
		      						<td ng-hide="dg.tipo!=1 " style="background-color: #80cbc4 ">{{((dg.tipo==1)?"NORMAL":"EMERRGENCIA")}}</td>

		      						<td>{{((dg.estado==1)? "ACTIVA":"INACTIVA")}}</td>

		      						<td>


                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li ng-disabled=" list_permisos.access_edit==0 " ng-click="edit_cita(dg)" ng-hide=" list_permisos.access_edit==0 " >
                                                    <a href="">
                                                        <i class="glyphicon glyphicon-edit"></i> Editar Cita
                                                    </a>
                                                </li>
                                                <li ng-disabled=" list_permisos.access_delete==0 " ng-hide=" list_permisos.access_delete==0 "  ng-click="int_estado(dg);" >
                                                    <a href="">
                                                        <i class="glyphicon glyphicon-trash"></i> Cancelar Cita
                                                    </a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li ng-click="ready_cita(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-list-alt"></i> Anamnesis
                                                    </a>
                                                </li>

                                                <li ng-click="ready_receta(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-list"></i> Receta
                                                    </a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li ng-click="ready_odontograma(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-list-alt"></i> Odontograma
                                                    </a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li ng-click="print_anamnesis(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-print"></i> Anamnesis
                                                    </a>
                                                </li>

                                                <li ng-click="print_receta(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-print"></i> Receta
                                                    </a>
                                                </li>

                                                <li ng-click="print_odontograma(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-print"></i> Odontograma
                                                    </a>
                                                </li>


												<li role="separator" class="divider"></li>

                                                <li ng-click="end_consulta(dg)">
                                                    <a href="" >
                                                        <i class="glyphicon glyphicon-ok-circle"></i> Finalizar consulta
                                                    </a>
                                                </li>

                                                
                                                
                                            </ul>
                                        </div>

		      							<!--<div class="btn-group" role="group" >
                                            <button class="btn btn-default btn-sm" ng-disabled=" list_permisos.access_edit==0 "
                                                    ng-click="ready_cita(dg)">
                                                <i class="glyphicon glyphicon-list-alt"   ></i>
                                            </button>

                                            <button class="btn btn-info btn-sm" ng-disabled=" list_permisos.access_edit==0 "
                                                    ng-click="edit_cita(dg)">
                                                <i class="glyphicon glyphicon-edit"   ></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" ng-disabled=" list_permisos.access_delete==0 "
                                                    ng-click="int_estado(dg);" >
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </div>-->
		      						</td>

		      					</tr>
		      				</tbody>
		      			</table>
		      		</div>
				</div>				



				<div class="row" ng-hide=" tipo_calendar!='AG' " >
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
							        	<button class="btn btn-danger btn-sm" type="button" disabled  ng-click="limpiar_empleado();">
							        		<i class="glyphicon glyphicon-trash"></i>
							        	</button>
							        	<button class="btn btn-default btn-sm" type="button" disabled ng-click="buscar_empleado()">
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
									<button class="btn btn-success btn-sm" type="button" ng-click="save_agenda();" 
										ng-disabled="list_permisos.access_save==0 || frm_agenda.$invalid " ng-hide="list_permisos.access_save==0 || aux_edit_cita.id_ag!=undefined || aux_edit_cita.id_ag!=null ">
										<i class="glyphicon glyphicon-calendar"></i>
										Agendar
									</button>

									<button class="btn btn-info btn-sm" type="button" ng-click="save_edit_agenda();" 
										ng-disabled="list_permisos.access_edit==0 ||  frm_agenda.$invalid " ng-hide="list_permisos.access_edit==0 || aux_edit_cita.id_ag==undefined || aux_edit_cita.id_ag==null ">
										<i class="glyphicon glyphicon-calendar"></i>
										Agendar
									</button>


									<button class="btn btn-default btn-sm" type="button" 
										ng-click="clear_agenda(); control_panel('D'); "  >
										<i class="glyphicon glyphicon-ban-circle"></i>
										Cancelar
									</button>	
								</div>
								

							</div>
						</div>
					</form>
				</div>

                <!--FORMULARIO 002 – CONSULTA EXTERNA -->
                <div class="row table-responsive" ng-hide=" tipo_calendar!='CIT' ">

                    <div class="col-xs-12 text-center">
                        <div class="btn-group" >
                            <button class="btn btn-sm btn-success" ng-click="save_anamnesis();"     ng-hide=" aux_anamnesis[0].id_cone!=null || aux_anamnesis[0].id_cone!=undefined ">
                            	<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
                            </button>
                            <button class="btn btn-sm btn-primary" ng-click="save_edit_anamnesis();" ng-hide=" aux_anamnesis[0].id_cone==null || aux_anamnesis[0].id_cone==undefined">
                            	<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
                            </button>
                            <button class="btn btn-sm btn-default" ng-click="control_panel2('D');"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped table-condensend">
                        <tr>
                            <th> Establecimiento</th>
                            <th colspan="2">Nombre</th>
                            <th>Sexo</th>
                            <th>Edad</th>
                            <th>Nº Historia Clínica </th>
                        </tr>
                        <tr>
                            <td>{{datos_cita.usuario.persona.personaempresa[0].empresa.nombre}}</td>
                            <td colspan="2">{{datos_cita.cliente.persona.apellido+" "+datos_cita.cliente.persona.nombre}}</td>
                            <td>{{datos_cita.cliente.persona.genero}}</td>
                            <td>{{calcular_edad(datos_cita.cliente.persona.fechan)}}</td>
                            <td>{{datos_cita.cliente.numerohistoria}} </td>
                        </tr>

                        <tr>
                            <th colspan="6">1 Motivo De La Consulta</th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <textarea class="form-control input-sm" cols="100" rows="2" name="motivoconsulta" id="motivoconsulta" ng-model="aux_anamnesis[0].motivo"></textarea>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <div class="col-md-6 col-xs-6">2 Antecedentes Personales</div>
                                <div class="col-md-6 col-xs-6 text-right" style="font-size: 8px;"> Datos Clínicos- Quirurgicos Relevante  Y Gineco Obstétricos</div>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <textarea class="form-control input-sm" cols="100" rows="2" name="antecedentespersonales" id="antecedentespersonales" ng-model="aux_anamnesis[0].antecedentespersonales"></textarea>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">3 Antecedentes Familiares</th>
                        </tr>

                        <tr>
                            <td colspan="6" >



                                    <div class="col-md-2 col-xs-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="cardiopatia" id="cardiopatia" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].cardiopatia"  ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].cardiopatia==1" > 1. Cardiopatía
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-md-2 col-xs-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="diabetes" id="diabetes" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].diabetes" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].diabetes==1" > 2. Diabetes
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-md-2 col-xs-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="carvascular" id="carvascular" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].vascular"
                                                       ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].vascular==1" > 3. Enf. Car. Vascular
                                            </label>
                                        </div>
                                    </div>

                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="cancer" id="cancer" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].hipertencion" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].hipertencion==1"  > 4. Hipertensión
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="cancer" id="cancer" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].cancer" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].cancer==1"  > 5. Cáncer
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="tuberculosis" id="tuberculosis" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].tuberculosis" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].tuberculosis==1"  > 6. Tuberculosis
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="mental" id="mental" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].enfmental" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].enfmental==1" > 7. Enf. Mental
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="infecciosa" id="infecciosa" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].enfinfecciosa"  ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].enfinfecciosa==1" > 8. Enf. Infecciosa
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="malformacion" id="malformacion" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].malformacion" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].malformacion==1" > 9. Mal Formación
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-2 col-xs-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="otros" id="otros" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].otro" ng-checked="aux_anamnesis[0].antecedentesfamiliares[0].otro==1" > 10. Otros
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xs-12">
                                    <textarea class="form-control input-sm" cols="100" rows="2" name="antecedentesfamiliares" id="antecedentesfamiliares" ng-model="aux_anamnesis[0].antecedentesfamiliares[0].descripcion"></textarea>
                                </div>


                            </td>
                        </tr>
                        <tr>
                            <th colspan="6">4. Enfermedad O Problema Actual</th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <textarea class="form-control input-sm" cols="100" rows="2" name="enfermedadproblemaactual" id="enfermedadproblemaactual" ng-model="aux_anamnesis[0].enfermedadactual"></textarea>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <div class="col-xs-6">
                                    5. Revisiòn Actual De Òrganos Y Sistemas
                                </div>
                                <div class="col-xs-3 text-right" style="font-size: 9px;"><strong>CP</strong>= Con evidencia de patologìa</div>
                                <div class="col-xs-3 text-right" style="font-size: 9px;"><strong>SP</strong>= Sin evidencia de patologìa</div>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6" >
                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >1 Òrganos De Los Sentidos CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_sentidos" id="cp_sentidos" ng-model="aux_anamnesis[0].organossistemas[0].sentidos_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_sentidos" id="sp_sentidos" ng-model="aux_anamnesis[0].organossistemas[0].sentidos_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >2 Respiratorio CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_respiratorio" id="cp_respiratorio" ng-model="aux_anamnesis[0].organossistemas[0].respiratorio_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_respiratorio" id="sp_respiratorio" ng-model="aux_anamnesis[0].organossistemas[0].respiratorio_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >3 Cardio Vascular CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_cardiovascular" id="cp_cardiovascular" ng-model="aux_anamnesis[0].organossistemas[0].vascular_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_cardiovascular" id="sp_cardiovascular" ng-model="aux_anamnesis[0].organossistemas[0].vascular_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >4 Digestivo CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_digestivo" id="cp_digestivo" ng-model="aux_anamnesis[0].organossistemas[0].digestivo_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_digestivo" id="sp_digestivo" ng-model="aux_anamnesis[0].organossistemas[0].digestivo_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >5 Genital CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_genital" id="cp_genital" ng-model="aux_anamnesis[0].organossistemas[0].genital_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_genital" id="sp_genital" ng-model="aux_anamnesis[0].organossistemas[0].genital_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >6 Urinario CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_urinario" id="cp_urinario" ng-model="aux_anamnesis[0].organossistemas[0].urinario_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_urinario" id="sp_urinario" ng-model="aux_anamnesis[0].organossistemas[0].urinario_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >7 Mùsculo Esquelètico</span>
                                        <input type="text" class="form-control input-sm" name="cp_musculoesqueletico" id="cp_musculoesqueletico" ng-model="aux_anamnesis[0].organossistemas[0].mesqueletico_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_musculoesqueletico" id="sp_musculoesqueletico" ng-model="aux_anamnesis[0].organossistemas[0].mesqueletico_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >8 Endocrino CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_endocrino" id="cp_endocrino" ng-model="aux_anamnesis[0].organossistemas[0].endocrino_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_endocrino" id="sp_endocrino" ng-model="aux_anamnesis[0].organossistemas[0].endocrino_sp" >

                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >9 Hemo Limfàtico CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_hemolimfatico" id="cp_hemolimfatico" ng-model="aux_anamnesis[0].organossistemas[0].linfatico_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_hemolimfatico" id="sp_hemolimfatico" ng-model="aux_anamnesis[0].organossistemas[0].linfatico_sp" >

                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >10 Nervioso CP</span>
                                        <input type="text" class="form-control input-sm" name="cp_nervioso" id="cp_nervioso" ng-model="aux_anamnesis[0].organossistemas[0].nervioso_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_nervioso" id="sp_nervioso" ng-model="aux_anamnesis[0].organossistemas[0].nervioso_sp" >

                                    </div>
                                </div>

                                <textarea class="form-control input-sm" cols="100" rows="2" name="revisionactualorganossistema" id="revisionactualorganossistema" ng-model="aux_anamnesis[0].organossistemas[0].descripcion"></textarea>


                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">6. Signos Vitales Y Antropometria</th>
                        </tr>

                        <tr>
                            <th colspan="6">

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >Fecha De Mediciòn</span>
                                        <input type="text" class="form-control input-sm datepicker" name="fechamedicionsignosvitales" id="fechamedicionsignosvitales" ng-model="aux_anamnesis[0].signosvitales[0].fechamedicion">
                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >Temperatura °C</span>
                                        <input type="text" class="form-control input-sm " name="temperaturasignosvitales" id="temperaturasignosvitales" ng-model="aux_anamnesis[0].signosvitales[0].temperatura">
                                    </div>
                                </div>


                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size: 9px !important;">Presiòn Arterial </span>
                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" id="presionarterial1signosvitales" name="presionarterial1signosvitales" ng-model="aux_anamnesis[0].signosvitales[0].presionarterial"  >
	                                    </span>
                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" id="presionarterial2signosvitales" name="presionarterial2signosvitales" ng-model="presionarterial2signosvitales" >
                                        </span>
                                    </div>
                                </div>


                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> Pulso min  / Frecuencia Respiratoria </span>
                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" id="pulsosignosvitales" name="pulsosignosvitales" ng-model="aux_anamnesis[0].signosvitales[0].pulso"  >
	                                    </span>
                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" id="frecuenciarespiratoriasignosvitales" name="frecuenciarespiratoriasignosvitales" ng-model="aux_anamnesis[0].signosvitales[0].frerespiratoria" >
                                        </span>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> Peso kg  / Talla cm </span>
                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" id="pesosignosvitales" name="pesosignosvitales" ng-model="aux_anamnesis[0].signosvitales[0].peso"  >
	                                    </span>
                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" id="tallasignosvitales" name="tallasignosvitales" ng-model="aux_anamnesis[0].signosvitales[0].talla" >
                                        </span>
                                    </div>
                                </div>



                            </th>
                        </tr>


                        <tr>
                            <th colspan="6">
                                <div class="col-xs-6">
                                    7. Examen Fìsico Regional
                                </div>
                                <div class="col-xs-3 text-right" style="font-size: 9px;"><strong>CP</strong>= Con evidencia de patologìa</div>
                                <div class="col-xs-3 text-right" style="font-size: 9px;"><strong>SP</strong>= Sin evidencia de patologìa</div>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >1 Cabeza</span>
                                        <input type="text" class="form-control input-sm" name="cp_fisicoregionalcabeza" id="cp_fisicoregionalcabeza" ng-model="aux_anamnesis[0].fisicoregional[0].cabeza_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_fisicoregionalcabeza" id="sp_fisicoregionalcabeza" ng-model="aux_anamnesis[0].fisicoregional[0].cabeza_sp" >

                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >2 Cuello</span>
                                        <input type="text" class="form-control input-sm" name="cp_fisicoregionalcuello" id="cp_fisicoregionalcuello" ng-model="aux_anamnesis[0].fisicoregional[0].cuello_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_fisicoregionalcuello" id="sp_fisicoregionalcuello" ng-model="aux_anamnesis[0].fisicoregional[0].cuello_sp" >

                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >3 Tórax</span>
                                        <input type="text" class="form-control input-sm" name="cp_fisicoregionaltorax" id="cp_fisicoregionaltorax" ng-model="aux_anamnesis[0].fisicoregional[0].torax_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_fisicoregionaltorax" id="sp_fisicoregionaltorax" ng-model="aux_anamnesis[0].fisicoregional[0].torax_sp" >

                                    </div>
                                </div>

                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >4 Abdomen</span>
                                        <input type="text" class="form-control input-sm" name="cp_fisicoregionalabdomen" id="cp_fisicoregionalabdomen" ng-model="aux_anamnesis[0].fisicoregional[0].abdomen_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_fisicoregionalabdomen" id="sp_fisicoregionalabdomen" ng-model="aux_anamnesis[0].fisicoregional[0].abdomen_sp" >

                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >5 Pelvis</span>
                                        <input type="text" class="form-control input-sm" name="cp_fisicoregionalpelvis" id="cp_fisicoregionalpelvis" ng-model="aux_anamnesis[0].fisicoregional[0].pelvis_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_fisicoregionalpelvis" id="sp_fisicoregionalpelvis" ng-model="aux_anamnesis[0].fisicoregional[0].pelvis_sp" >

                                    </div>
                                </div>


                                <div class="col-xs-4" >
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="font-size: 9px !important;" >6 Extremidades</span>
                                        <input type="text" class="form-control input-sm" name="cp_fisicoregionalextremidades" id="cp_fisicoregionalextremidades" ng-model="aux_anamnesis[0].fisicoregional[0].extremidades_cp">
                                        <span class="input-group-addon" style="font-size: 9px !important;"> SP</span>
                                        <input type="text" class="form-control input-sm" name="sp_fisicoregionalextremidades" id="sp_fisicoregionalextremidades" ng-model="aux_anamnesis[0].fisicoregional[0].extremidades_sp" >

                                    </div>
                                </div>

                                <textarea class="form-control input-sm" cols="100" rows="2" name="fisicoregional" id="fisicoregional" ng-model="aux_anamnesis[0].fisicoregional[0].descripcion"></textarea>

                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <div class="col-xs-6">
                                    8. Diagnostico <button class="btn btn-primary btn-sm" ng-click="find_cie();" title="Agregar"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                                <div class="col-xs-3 text-right" style="font-size: 9px;"><strong>PRE</strong>= Presuntivo</div>
                                <div class="col-xs-3 text-right" style="font-size: 9px;"><strong>DEF</strong>= Definitivo</div>
                            </th>
                        </tr>


                        <tr>
                            <th colspan="6">

                                <div class="col-xs-6" ng-repeat=" d in aux_anamnesis[0].diagnostico">
                                    <div class="input-group">
                                        <span class="input-group-btn" style="width: 50%;">
                                            <input type="text" class="form-control input-sm" id="diagnosticodescripcion" name="diagnosticodescripcion" readonly ng-model="d.cie.descripcion"  >
	                                    </span>
                                        <span class="input-group-btn" style="width: 20%;">
                                            <input type="text" class="form-control input-sm" placeholder="CIE" id="diagnosticocie" name="diagnosticocie" readonly ng-model="d.cie.codigo" >
                                        </span>

                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" placeholder="PRE"  id="diagnosticopre" name="diagnosticopre" ng-model="d.presuntivo" >
                                        </span>

                                        <span class="input-group-btn" style="width: 15%;">
                                            <input type="text" class="form-control input-sm" placeholder="DEF" id="diagnosticodef" name="diagnosticodef" ng-model="d.definitivo" >
                                        </span>
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete_cie(d)"><i class="glyphicon glyphicon-trash"></i></button>
                                    </div>
                                </div>

                               





                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <div class="col-xs-6">
                                    9. Planes De Tratamiento
                                </div>
                                <div class="col-xs-6 text-right" style="font-size: 9px;">Planes De Diagnostico, Terapéutico Y Educacional</div>

                            </th>
                        </tr>

                        <tr>
                            <th colspan="6">
                                <textarea class="form-control input-sm" cols="100" rows="2" name="planestratamiento" id="planestratamiento" ng-model="aux_anamnesis[0].planestratamiento"></textarea>
                            </th>
                        </tr>


                    </table>

                </div>
                <!--FORMULARIO 002 – CONSULTA EXTERNA -->

                <!-- FORMULARIO DE RECETA-->
                <div class="row" ng-hide=" tipo_calendar!='DIAG' ">
                	<h5><strong>Prescripción Medica</strong> </h5>
                	<div class="row">
                		<div class="col-md-12 col-xs-12 text-center">
                			<div class="btn-group" >
                				<button type="button" class="btn btn-default btn-sm" ng-click="add_vademecum();">
	                				<i class="glyphicon glyphicon-plus"></i>  Medicamento
	                			</button>

	                			<button type="button" class="btn btn-success btn-sm" ng-click="save_receta();"
                                    ng-hide="list_receta[0].id_presit!=null && list_receta[0].id_presit!=undefined">
	                				<i class="glyphicon glyphicon-floppy-saved"></i>  Guardar
	                			</button>

	                			<button type="button" class="btn btn-primary btn-sm" ng-click="edit_receta();" title="Editar"
                                        ng-hide="list_receta[0].id_presit==null && list_receta[0].id_presit==undefined">
	                				<i class="glyphicon glyphicon-floppy-saved"></i>  Guardar
	                			</button>

	                			<button type="button" class="btn btn-info btn-sm" ng-click="save_receta();" title="Guardar Como Nueva Prescripción Medica"
                                        ng-hide="list_receta[0].id_presit==null && list_receta[0].id_presit==undefined">
	                				<i class="glyphicon glyphicon-floppy-saved"></i>  Guardar 
	                			</button>


	                			<button type="button" class="btn btn-default btn-sm" ng-click="control_panel2('D');">
	                				<i class="glyphicon glyphicon-ban-circle"></i>  Cancelar
	                			</button>
                			</div>
                			
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-xs-12 table-responsive">
                			<table class="table table-bordered table-condensend">
                				<thead>
                					<tr class="bg-primary">
                						<th></th>
                						<th>Medicamento</th>
                						<th style="width:20%; " >Dosis</th>
                						<th>Indicaciones</th>
                                        <th></th>
                					</tr>
                				</thead>
                				<tbody>
                					<tr ng-repeat="m in list_receta">
                                        <td>{{$index+1}}</td>
                                        <td>{{m.item.descripcion}}</td>
                                        <td><input type="text" class="form-control input-sm "  ng-model="m.cantidad"></td>
                                        <td><input type="text" class="form-control input-sm " ng-model="m.indicaciones"></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" ng-click="delete_medicamento(m)">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                				</tbody>
                			</table>
                		</div>
                	</div>
                </div>
                <!-- FORMULARIO DE RECETA-->

                <!-- ODONTOGRAMA PARTE DEL FORMULARIO 033-->
                <div class="row" ng-hide=" tipo_calendar!='ODONT' ">
                	<h3>Odontograma</h3>
                	<div class="row">
                		<div class="col-md-5 col-xs-12">
                			<div class="input-group ">
                				<span class="btn btn-sm input-group-addon">Tratamiento</span>
                				<select class="form-control input-sm "  name="tratamiento" id="tratamiento" ng-model="tratamiento">
                					<option value="">Seleccione</option>
                					<option ng-repeat=" tr in list_tratamientos" value="{{tr.id_trod}}">{{tr.descripcion}}</option>
                				</select>
                			</div>
                		</div>

                		<div class="col-md-6 col-xs-12 text-center btn-group">
                			
                			<button type="button" class="btn btn-success btn-sm" ng-click="save_odontograma()">
                				<i class="glyphicon glyphicon-floppy-saved"></i> Guardar
                			</button>
                			<button type="button" class="btn btn-default btn-sm" ng-click="control_panel2('D');">
                				<i class="glyphicon glyphicon-ban-circle"></i> Cancelar
                			</button>

                			<div class="checkbox">
                				<label>
                					<input type="checkbox" ng-model="delete_tratamiento" id="delete_tratamiento">
                					Eliminar tratamiento
                				</label>
                			</div>
                		</div>

                	</div>
                	
                	<table class="">
                		<tr>
                			<th>Recesión</th>
                			<td ng-repeat=" v1811 in odontograma.vestibular1811 "><input type="text" style="width: 40px;" ng-model=" v1811.text1" class="form-control" name=""></td>
                			<td style="width: 25px;"></td>
                			<td style="width: 25px;"></td>
                			<td ng-repeat=" v2128 in odontograma.vestibular2128 "><input type="text" style="width: 40px;" ng-model=" v2128.text1" class="form-control" name=""></td>
                		</tr>
                		<tr>
                			<th>Movilidad</th>
                			<td ng-repeat=" v1811 in odontograma.vestibular1811 "><input type="text" style="width: 40px;" ng-model=" v1811.text2" class="form-control" name=""></td>
                			<td style="width: 25px;"></td>
                			<td style="width: 25px;"></td>
                			<td ng-repeat=" v2128 in odontograma.vestibular2128 "><input type="text" style="width: 40px;" ng-model=" v2128.text2" class="form-control" name=""></td>
                		</tr>
                		<tr>
                			<td></td>
                			<td ng-repeat=" v1811 in odontograma.vestibular1811 ">{{v1811.id_numero}}</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td ng-repeat=" v2128 in odontograma.vestibular2128 ">{{v2128.id_numero}}</td>
                		</tr>
                		<tr>
                			<th>Vestibular</th>
                			<td ng-repeat=" v1811 in odontograma.vestibular1811 " >
                				<svg xmlns="http://www.w3.org/2000/svg"  version="1.1" style="height: 50px; width: 40px;" viewBox="0 0 194 186"  width="150" height="150">  
								  <polygon points="100,50  150,20  150,20  0,20  50,50"
								  	class="arriba"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_up(v1811)" 
								  

								   ng-style="{'fill': v1811.arriba_color != '' ? v1811.arriba_color : 'rgb(255,255,255)'}"

								   />

								  <rect x="50" y="50" width="50" height="50" 
								  class="center"
								  style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_center(v1811)"
								  ng-style="{'fill': v1811.centro_color != '' ? v1811.centro_color : 'rgb(255,255,255)'}"
								  />

								  <polygon points="100,100 50,100 0,130  0,130  150,130"
								  	class="abajo" 
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_down(v1811)" 
								   	ng-style="{'fill': v1811.abajo_color != '' ? v1811.abajo_color : 'rgb(255,255,255)'}"
								   />

								   <polygon points="100,100 100,50 150,20 150,130  150,130"
								  	class="derecha"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_right(v1811)"
								   ng-style="{'fill': v1811.derecha_color != '' ? v1811.derecha_color : 'rgb(255,255,255)'}"
								   />

								   <polygon points="50,100 50,50 0,20 0,130  0,130"
								  	class="izquierda"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_left(v1811)"
								   ng-style="{'fill': v1811.izquierda_color != '' ? v1811.izquierda_color : 'rgb(255,255,255)'}"
								   />
								</svg>
                			</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td ng-repeat=" v2128 in odontograma.vestibular2128 " >
                				<svg xmlns="http://www.w3.org/2000/svg"  version="1.1" style="height: 50px; width: 40px;" viewBox="0 0 194 186"  width="150" height="150">  
								  <polygon points="100,50  150,20  150,20  0,20  50,50"
								  	class="arriba" 
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)"  ng-click="aplicar_tratamiento_up(v2128)" 
								   ng-style="{'fill': v2128.arriba_color != '' ? v2128.arriba_color : 'rgb(255,255,255)'}"/>

								  <rect x="50" y="50" width="50" height="50" 
								  class="center"
								  style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_center(v2128)"
								  ng-style="{'fill': v2128.centro_color != '' ? v2128.centro_color : 'rgb(255,255,255)'}"/>

								  <polygon points="100,100 50,100 0,130  0,130  150,130"
								  	class="abajo"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_down(v2128)" 
								   	ng-style="{'fill': v2128.abajo_color != '' ? v2128.abajo_color : 'rgb(255,255,255)'}" />

								   <polygon points="100,100 100,50 150,20 150,130  150,130"
								  	class="derecha"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_right(v2128)"
								   ng-style="{'fill': v2128.derecha_color != '' ? v2128.derecha_color : 'rgb(255,255,255)'}" />

								   <polygon points="50,100 50,50 0,20 0,130  0,130"
								  	class="izquierda"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_left(v2128)"
								   ng-style="{'fill': v2128.izquierda_color != '' ? v2128.izquierda_color : 'rgb(255,255,255)'}"/>
								</svg>
                			</td>
                		</tr>

                		<tr>
                			<td></td>
                			<td ng-repeat=" v1811 in odontograma.vestibular1811 ">
                				<img ng-repeat=" tr in v1811.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
                			</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td ng-repeat=" v2128 in odontograma.vestibular2128 ">
								<img ng-repeat=" tr in v2128.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
							</td>
                		</tr>

                		<tr>
                			<td></td>
                			<td></td>
                			<td></td>
                			<td ng-repeat=" l5551 in odontograma.lingual5551 " >{{l5551.id_numero}}</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td></td>
                			<td></td>
                			<td ng-repeat=" l6165 in odontograma.lingual6165 " >{{l6165.id_numero}}</td>
                			<td></td>
                			<td></td>
                		</tr>
                		<tr>
                			<th>Lingual</th>
                			<td></td>
                			<td></td>
                			<td ng-repeat=" l5551 in odontograma.lingual5551 " >
                				<svg style="height: 50px; width: 40px;" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
						           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
						           x="0px" y="0px" width="558px" height="557px" viewBox="0 0 558 557" enable-background="new 0 0 558 557" xml:space="preserve">
						        <switch>
						          <foreignObject requiredExtensions="&ns_ai;" x="0" y="0" width="1" height="1">
						            <i:pgfRef  xlink:href="#adobe_illustrator_pgf">
						            </i:pgfRef>
						          </foreignObject>
						          <g i:extraneous="self">
						            <g id="Capa_1">
						              <g>
						                <g>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,12.429c-147.684,0-267.404,119.721-267.404,267.404
						                    s119.721,267.404,267.404,267.404s267.404-119.721,267.404-267.404S426.324,12.429,278.641,12.429z M467.139,279.833
						                    c0,52.054-21.099,99.179-55.209,133.289l55.793,55.793l-55.793-55.793c-34.112,34.11-81.237,55.209-133.289,55.209
						                    c-52.053,0-99.177-21.099-133.289-55.209l-55.794,55.793l55.794-55.793c-34.11-34.112-55.209-81.237-55.209-133.289
						                    s21.099-99.176,55.209-133.289L89.557,90.75l55.794,55.793c34.112-34.11,81.236-55.209,133.289-55.209
						                    c52.052,0,99.177,21.099,133.289,55.209l55.793-55.793l-55.793,55.793C446.04,180.655,467.139,227.779,467.139,279.833z"/>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,548.333c-148.052,0-268.5-120.448-268.5-268.5
						                    s120.448-268.5,268.5-268.5s268.5,120.448,268.5,268.5S426.692,548.333,278.641,548.333z M91.197,468.825
						                    c48.158,47.767,114.417,77.316,187.444,77.316c73.026,0,139.284-29.55,187.442-77.314l-54.155-54.157
						                    c-35.723,35.321-83.01,54.757-133.287,54.757s-97.565-19.436-133.287-54.757L91.197,468.825z M413.478,413.12l54.157,54.155
						                    c47.765-48.158,77.314-114.416,77.314-187.442s-29.55-139.284-77.314-187.443l-54.157,54.156
						                    c35.321,35.72,54.757,83.007,54.757,133.287C468.234,330.113,448.799,377.399,413.478,413.12z M89.646,92.39
						                    C41.88,140.549,12.333,206.807,12.333,279.833S41.88,419.117,89.646,467.275l54.158-54.155
						                    c-35.321-35.723-54.757-83.01-54.757-133.287c0-50.275,19.437-97.564,54.757-133.287L89.646,92.39z M146.044,412.264
						                    l0.083,0.083c35.396,35.396,82.457,54.889,132.514,54.889c50.017,0,97.044-19.464,132.431-54.805l0.083-0.084
						                    c35.396-35.395,54.889-82.457,54.889-132.514s-19.493-97.119-54.889-132.514l-0.083-0.083
						                    c-35.387-35.341-82.414-54.804-132.431-54.804c-50.057,0-97.118,19.493-132.514,54.888l-0.083,0.083
						                    c-35.342,35.386-54.805,82.415-54.805,132.431S110.702,376.878,146.044,412.264z M278.641,90.239
						                    c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158c-48.158-47.764-114.416-77.313-187.442-77.313
						                    c-73.027,0-139.286,29.549-187.444,77.316l54.157,54.156C181.075,109.675,228.363,90.239,278.641,90.239z"/>
						                </g>
						              </g>
						            </g>
						            <g id="Capa_2">
						              <path class="arriba" style="fill:rgb(255,255,255);" d="M278.641,90.239c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158
						                c-48.158-47.764-114.416-77.313-187.442-77.313S139.354,43.074,91.198,90.841l54.156,54.156
						                C181.076,109.675,228.363,90.239,278.641,90.239z" ng-click="aplicar_tratamiento_up(l5551)" 
								   ng-style="{'fill': l5551.arriba_color != '' ? l5551.arriba_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_3">
						              <path class="derecha" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M468.56,280.161c0,50.275-19.436,97.562-54.757,133.287l54.158,54.154
						                c47.767-48.156,77.313-114.417,77.313-187.441c0-73.028-29.547-139.289-77.313-187.445l-54.158,54.158
						                C449.124,182.594,468.56,229.881,468.56,280.161z" ng-click="aplicar_tratamiento_right(l5551)"
								   ng-style="{'fill': l5551.derecha_color != '' ? l5551.derecha_color : 'rgb(255,255,255)'}"/>
						            </g>
						            <g id="Capa_4">
						              <path class="abajo" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)"  d="M278.641,470.08c-50.277,0-97.564-19.436-133.287-54.758L91.198,469.48
						                c48.159,47.765,114.417,77.313,187.443,77.313s139.286-29.549,187.442-77.315l-54.155-54.156
						                C376.205,450.645,328.918,470.08,278.641,470.08z" ng-click="aplicar_tratamiento_down(l5551)" 
								   	ng-style="{'fill': l5551.abajo_color != '' ? l5551.abajo_color : 'rgb(255,255,255)'}"/>
						            </g>
						            <g id="Capa_5">
						              <path class="izquierda" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M88.72,280.161c0-50.28,19.436-97.567,54.757-133.287L89.32,92.716
						                c-47.765,48.16-77.314,114.417-77.314,187.445c0,73.024,29.549,139.285,77.316,187.441l54.156-54.154
						                C108.156,377.723,88.72,330.436,88.72,280.161z" ng-click="aplicar_tratamiento_left(l5551)"
								   ng-style="{'fill': l5551.izquierda_color != '' ? l5551.izquierda_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_6">
						              <circle class='center' style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" cx="278.902" cy="279.699" r="187.352" ng-click="aplicar_tratamiento_center(l5551)"
								  ng-style="{'fill': l5551.centro_color != '' ? l5551.centro_color : 'rgb(255,255,255)'}"/>
						            </g>
						          </g>
						        </switch>

						        </svg>
                			</td>
                			<td></td>
                			<td style="width: 25px;"></td>
                			<td style="width: 25px;"></td>
                			
                			<td></td>
                			<td ng-repeat=" l6165 in odontograma.lingual6165 " >
                				<svg style="height: 50px; width: 40px;" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
						           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
						           x="0px" y="0px" width="558px" height="557px" viewBox="0 0 558 557" enable-background="new 0 0 558 557" xml:space="preserve">
						        <switch>
						          <foreignObject requiredExtensions="&ns_ai;" x="0" y="0" width="1" height="1">
						            <i:pgfRef  xlink:href="#adobe_illustrator_pgf">
						            </i:pgfRef>
						          </foreignObject>
						          <g i:extraneous="self">
						            <g id="Capa_1">
						              <g>
						                <g>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,12.429c-147.684,0-267.404,119.721-267.404,267.404
						                    s119.721,267.404,267.404,267.404s267.404-119.721,267.404-267.404S426.324,12.429,278.641,12.429z M467.139,279.833
						                    c0,52.054-21.099,99.179-55.209,133.289l55.793,55.793l-55.793-55.793c-34.112,34.11-81.237,55.209-133.289,55.209
						                    c-52.053,0-99.177-21.099-133.289-55.209l-55.794,55.793l55.794-55.793c-34.11-34.112-55.209-81.237-55.209-133.289
						                    s21.099-99.176,55.209-133.289L89.557,90.75l55.794,55.793c34.112-34.11,81.236-55.209,133.289-55.209
						                    c52.052,0,99.177,21.099,133.289,55.209l55.793-55.793l-55.793,55.793C446.04,180.655,467.139,227.779,467.139,279.833z"/>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,548.333c-148.052,0-268.5-120.448-268.5-268.5
						                    s120.448-268.5,268.5-268.5s268.5,120.448,268.5,268.5S426.692,548.333,278.641,548.333z M91.197,468.825
						                    c48.158,47.767,114.417,77.316,187.444,77.316c73.026,0,139.284-29.55,187.442-77.314l-54.155-54.157
						                    c-35.723,35.321-83.01,54.757-133.287,54.757s-97.565-19.436-133.287-54.757L91.197,468.825z M413.478,413.12l54.157,54.155
						                    c47.765-48.158,77.314-114.416,77.314-187.442s-29.55-139.284-77.314-187.443l-54.157,54.156
						                    c35.321,35.72,54.757,83.007,54.757,133.287C468.234,330.113,448.799,377.399,413.478,413.12z M89.646,92.39
						                    C41.88,140.549,12.333,206.807,12.333,279.833S41.88,419.117,89.646,467.275l54.158-54.155
						                    c-35.321-35.723-54.757-83.01-54.757-133.287c0-50.275,19.437-97.564,54.757-133.287L89.646,92.39z M146.044,412.264
						                    l0.083,0.083c35.396,35.396,82.457,54.889,132.514,54.889c50.017,0,97.044-19.464,132.431-54.805l0.083-0.084
						                    c35.396-35.395,54.889-82.457,54.889-132.514s-19.493-97.119-54.889-132.514l-0.083-0.083
						                    c-35.387-35.341-82.414-54.804-132.431-54.804c-50.057,0-97.118,19.493-132.514,54.888l-0.083,0.083
						                    c-35.342,35.386-54.805,82.415-54.805,132.431S110.702,376.878,146.044,412.264z M278.641,90.239
						                    c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158c-48.158-47.764-114.416-77.313-187.442-77.313
						                    c-73.027,0-139.286,29.549-187.444,77.316l54.157,54.156C181.075,109.675,228.363,90.239,278.641,90.239z"/>
						                </g>
						              </g>
						            </g>
						            <g id="Capa_2">
						              <path class="arriba" style="fill:rgb(255,255,255);" d="M278.641,90.239c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158
						                c-48.158-47.764-114.416-77.313-187.442-77.313S139.354,43.074,91.198,90.841l54.156,54.156
						                C181.076,109.675,228.363,90.239,278.641,90.239z" ng-click="aplicar_tratamiento_up(l6165)" 
								   ng-style="{'fill': l6165.arriba_color != '' ? l6165.arriba_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_3">
						              <path class="derecha" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M468.56,280.161c0,50.275-19.436,97.562-54.757,133.287l54.158,54.154
						                c47.767-48.156,77.313-114.417,77.313-187.441c0-73.028-29.547-139.289-77.313-187.445l-54.158,54.158
						                C449.124,182.594,468.56,229.881,468.56,280.161z" ng-click="aplicar_tratamiento_right(l6165)"
								   ng-style="{'fill': l6165.derecha_color != '' ? l6165.derecha_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_4">
						              <path class="abajo" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)"  d="M278.641,470.08c-50.277,0-97.564-19.436-133.287-54.758L91.198,469.48
						                c48.159,47.765,114.417,77.313,187.443,77.313s139.286-29.549,187.442-77.315l-54.155-54.156
						                C376.205,450.645,328.918,470.08,278.641,470.08z" ng-click="aplicar_tratamiento_down(l6165)" 
								   	ng-style="{'fill': l6165.abajo_color != '' ? l6165.abajo_color : 'rgb(255,255,255)'}"/>
						            </g>
						            <g id="Capa_5">
						              <path class="izquierda" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M88.72,280.161c0-50.28,19.436-97.567,54.757-133.287L89.32,92.716
						                c-47.765,48.16-77.314,114.417-77.314,187.445c0,73.024,29.549,139.285,77.316,187.441l54.156-54.154
						                C108.156,377.723,88.72,330.436,88.72,280.161z" ng-click="aplicar_tratamiento_left(l6165)"
								   ng-style="{'fill': l6165.izquierda_color != '' ? l6165.izquierda_color : 'rgb(255,255,255)'}"  />
						            </g>
						            <g id="Capa_6">
						              <circle class='center' style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" cx="278.902" cy="279.699" r="187.352"  ng-click="aplicar_tratamiento_center(l6165)"
								  ng-style="{'fill': l6165.centro_color != '' ? l6165.centro_color : 'rgb(255,255,255)'}"/>
						            </g>
						          </g>
						        </switch>

						        </svg>
                			</td>
                			<td></td>
                			<td></td>
                		</tr>

                		<tr>
                			<td></td>
                			<td></td>
                			<td></td>
                			<td ng-repeat=" l5551 in odontograma.lingual5551 " >
                				<img ng-repeat=" tr in l5551.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
                			</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td></td>
                			<td></td>
                			<td ng-repeat=" l6165 in odontograma.lingual6165 " >
                				<img ng-repeat=" tr in l6165.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
                			</td>
                			<td></td>
                			<td></td>
                		</tr>


						<tr>
                			<td></td>
                			<td></td>
                			<td></td>
                			<td ng-repeat=" l8581 in odontograma.lingual8581 " >{{l8581.id_numero}}</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td></td>
                			<td></td>
                			<td ng-repeat=" l7175 in odontograma.lingual7175 " >{{l7175.id_numero}}</td>
                			<td></td>
                			<td></td>
                		</tr>

                		<tr>
                			<th>Lingual</th>
                			<td></td>
                			<td></td>
                			<td ng-repeat=" l8581 in odontograma.lingual8581 " >
                				<svg style="height: 50px; width: 40px;" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
						           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
						           x="0px" y="0px" width="558px" height="557px" viewBox="0 0 558 557" enable-background="new 0 0 558 557" xml:space="preserve">
						        <switch>
						          <foreignObject requiredExtensions="&ns_ai;" x="0" y="0" width="1" height="1">
						            <i:pgfRef  xlink:href="#adobe_illustrator_pgf">
						            </i:pgfRef>
						          </foreignObject>
						          <g i:extraneous="self">
						            <g id="Capa_1">
						              <g>
						                <g>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,12.429c-147.684,0-267.404,119.721-267.404,267.404
						                    s119.721,267.404,267.404,267.404s267.404-119.721,267.404-267.404S426.324,12.429,278.641,12.429z M467.139,279.833
						                    c0,52.054-21.099,99.179-55.209,133.289l55.793,55.793l-55.793-55.793c-34.112,34.11-81.237,55.209-133.289,55.209
						                    c-52.053,0-99.177-21.099-133.289-55.209l-55.794,55.793l55.794-55.793c-34.11-34.112-55.209-81.237-55.209-133.289
						                    s21.099-99.176,55.209-133.289L89.557,90.75l55.794,55.793c34.112-34.11,81.236-55.209,133.289-55.209
						                    c52.052,0,99.177,21.099,133.289,55.209l55.793-55.793l-55.793,55.793C446.04,180.655,467.139,227.779,467.139,279.833z"/>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,548.333c-148.052,0-268.5-120.448-268.5-268.5
						                    s120.448-268.5,268.5-268.5s268.5,120.448,268.5,268.5S426.692,548.333,278.641,548.333z M91.197,468.825
						                    c48.158,47.767,114.417,77.316,187.444,77.316c73.026,0,139.284-29.55,187.442-77.314l-54.155-54.157
						                    c-35.723,35.321-83.01,54.757-133.287,54.757s-97.565-19.436-133.287-54.757L91.197,468.825z M413.478,413.12l54.157,54.155
						                    c47.765-48.158,77.314-114.416,77.314-187.442s-29.55-139.284-77.314-187.443l-54.157,54.156
						                    c35.321,35.72,54.757,83.007,54.757,133.287C468.234,330.113,448.799,377.399,413.478,413.12z M89.646,92.39
						                    C41.88,140.549,12.333,206.807,12.333,279.833S41.88,419.117,89.646,467.275l54.158-54.155
						                    c-35.321-35.723-54.757-83.01-54.757-133.287c0-50.275,19.437-97.564,54.757-133.287L89.646,92.39z M146.044,412.264
						                    l0.083,0.083c35.396,35.396,82.457,54.889,132.514,54.889c50.017,0,97.044-19.464,132.431-54.805l0.083-0.084
						                    c35.396-35.395,54.889-82.457,54.889-132.514s-19.493-97.119-54.889-132.514l-0.083-0.083
						                    c-35.387-35.341-82.414-54.804-132.431-54.804c-50.057,0-97.118,19.493-132.514,54.888l-0.083,0.083
						                    c-35.342,35.386-54.805,82.415-54.805,132.431S110.702,376.878,146.044,412.264z M278.641,90.239
						                    c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158c-48.158-47.764-114.416-77.313-187.442-77.313
						                    c-73.027,0-139.286,29.549-187.444,77.316l54.157,54.156C181.075,109.675,228.363,90.239,278.641,90.239z"/>
						                </g>
						              </g>
						            </g>
						            <g id="Capa_2">
						              <path class="arriba" style="fill:rgb(255,255,255);" d="M278.641,90.239c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158
						                c-48.158-47.764-114.416-77.313-187.442-77.313S139.354,43.074,91.198,90.841l54.156,54.156
						                C181.076,109.675,228.363,90.239,278.641,90.239z" ng-click="aplicar_tratamiento_up(l8581)" 
								   ng-style="{'fill': l8581.arriba_color != '' ? l8581.arriba_color : 'rgb(255,255,255)'}"  />
						            </g>
						            <g id="Capa_3">
						              <path class="derecha" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M468.56,280.161c0,50.275-19.436,97.562-54.757,133.287l54.158,54.154
						                c47.767-48.156,77.313-114.417,77.313-187.441c0-73.028-29.547-139.289-77.313-187.445l-54.158,54.158
						                C449.124,182.594,468.56,229.881,468.56,280.161z" ng-click="aplicar_tratamiento_right(l8581)"
								   ng-style="{'fill': l8581.derecha_color != '' ? l8581.derecha_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_4">
						              <path class="abajo" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)"  d="M278.641,470.08c-50.277,0-97.564-19.436-133.287-54.758L91.198,469.48
						                c48.159,47.765,114.417,77.313,187.443,77.313s139.286-29.549,187.442-77.315l-54.155-54.156
						                C376.205,450.645,328.918,470.08,278.641,470.08z" ng-click="aplicar_tratamiento_down(l8581)" 
								   	ng-style="{'fill': l8581.abajo_color != '' ? l8581.abajo_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_5">
						              <path class="izquierda" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M88.72,280.161c0-50.28,19.436-97.567,54.757-133.287L89.32,92.716
						                c-47.765,48.16-77.314,114.417-77.314,187.445c0,73.024,29.549,139.285,77.316,187.441l54.156-54.154
						                C108.156,377.723,88.72,330.436,88.72,280.161z" ng-click="aplicar_tratamiento_left(l8581)"
								   ng-style="{'fill': l8581.izquierda_color != '' ? l8581.izquierda_color : 'rgb(255,255,255)'}"   />
						            </g>
						            <g id="Capa_6">
						              <circle class='center' style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" cx="278.902" cy="279.699" r="187.352" ng-click="aplicar_tratamiento_center(l8581)"
								  ng-style="{'fill': l8581.centro_color != '' ? l8581.centro_color : 'rgb(255,255,255)'}"/>
						            </g>
						          </g>
						        </switch>

						        </svg>
						    </td>
						    <td></td>
						    <td style="width: 25px;"></td>
                			<td style="width: 25px;"></td>
                			<td></td>
                			<td ng-repeat=" l7175 in odontograma.lingual7175 " >
                				<svg style="height: 50px; width: 40px;" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
						           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
						           x="0px" y="0px" width="558px" height="557px" viewBox="0 0 558 557" enable-background="new 0 0 558 557" xml:space="preserve">
						        <switch>
						          <foreignObject requiredExtensions="&ns_ai;" x="0" y="0" width="1" height="1">
						            <i:pgfRef  xlink:href="#adobe_illustrator_pgf">
						            </i:pgfRef>
						          </foreignObject>
						          <g i:extraneous="self">
						            <g id="Capa_1">
						              <g>
						                <g>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,12.429c-147.684,0-267.404,119.721-267.404,267.404
						                    s119.721,267.404,267.404,267.404s267.404-119.721,267.404-267.404S426.324,12.429,278.641,12.429z M467.139,279.833
						                    c0,52.054-21.099,99.179-55.209,133.289l55.793,55.793l-55.793-55.793c-34.112,34.11-81.237,55.209-133.289,55.209
						                    c-52.053,0-99.177-21.099-133.289-55.209l-55.794,55.793l55.794-55.793c-34.11-34.112-55.209-81.237-55.209-133.289
						                    s21.099-99.176,55.209-133.289L89.557,90.75l55.794,55.793c34.112-34.11,81.236-55.209,133.289-55.209
						                    c52.052,0,99.177,21.099,133.289,55.209l55.793-55.793l-55.793,55.793C446.04,180.655,467.139,227.779,467.139,279.833z"/>
						                  <path fill="none" stroke="#000000" stroke-miterlimit="10" d="M278.641,548.333c-148.052,0-268.5-120.448-268.5-268.5
						                    s120.448-268.5,268.5-268.5s268.5,120.448,268.5,268.5S426.692,548.333,278.641,548.333z M91.197,468.825
						                    c48.158,47.767,114.417,77.316,187.444,77.316c73.026,0,139.284-29.55,187.442-77.314l-54.155-54.157
						                    c-35.723,35.321-83.01,54.757-133.287,54.757s-97.565-19.436-133.287-54.757L91.197,468.825z M413.478,413.12l54.157,54.155
						                    c47.765-48.158,77.314-114.416,77.314-187.442s-29.55-139.284-77.314-187.443l-54.157,54.156
						                    c35.321,35.72,54.757,83.007,54.757,133.287C468.234,330.113,448.799,377.399,413.478,413.12z M89.646,92.39
						                    C41.88,140.549,12.333,206.807,12.333,279.833S41.88,419.117,89.646,467.275l54.158-54.155
						                    c-35.321-35.723-54.757-83.01-54.757-133.287c0-50.275,19.437-97.564,54.757-133.287L89.646,92.39z M146.044,412.264
						                    l0.083,0.083c35.396,35.396,82.457,54.889,132.514,54.889c50.017,0,97.044-19.464,132.431-54.805l0.083-0.084
						                    c35.396-35.395,54.889-82.457,54.889-132.514s-19.493-97.119-54.889-132.514l-0.083-0.083
						                    c-35.387-35.341-82.414-54.804-132.431-54.804c-50.057,0-97.118,19.493-132.514,54.888l-0.083,0.083
						                    c-35.342,35.386-54.805,82.415-54.805,132.431S110.702,376.878,146.044,412.264z M278.641,90.239
						                    c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158c-48.158-47.764-114.416-77.313-187.442-77.313
						                    c-73.027,0-139.286,29.549-187.444,77.316l54.157,54.156C181.075,109.675,228.363,90.239,278.641,90.239z"/>
						                </g>
						              </g>
						            </g>
						            <g id="Capa_2">
						              <path class="arriba" style="fill:rgb(255,255,255);" d="M278.641,90.239c50.277,0,97.564,19.436,133.287,54.757l54.155-54.158
						                c-48.158-47.764-114.416-77.313-187.442-77.313S139.354,43.074,91.198,90.841l54.156,54.156
						                C181.076,109.675,228.363,90.239,278.641,90.239z" ng-click="aplicar_tratamiento_up(l7175)" 
								   ng-style="{'fill': l7175.arriba_color != '' ? l7175.arriba_color : 'rgb(255,255,255)'}"  />
						            </g>
						            <g id="Capa_3">
						              <path class="derecha" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M468.56,280.161c0,50.275-19.436,97.562-54.757,133.287l54.158,54.154
						                c47.767-48.156,77.313-114.417,77.313-187.441c0-73.028-29.547-139.289-77.313-187.445l-54.158,54.158
						                C449.124,182.594,468.56,229.881,468.56,280.161z" ng-click="aplicar_tratamiento_right(l7175)"
								   ng-style="{'fill': l7175.derecha_color != '' ? l7175.derecha_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_4">
						              <path class="abajo" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)"  d="M278.641,470.08c-50.277,0-97.564-19.436-133.287-54.758L91.198,469.48
						                c48.159,47.765,114.417,77.313,187.443,77.313s139.286-29.549,187.442-77.315l-54.155-54.156
						                C376.205,450.645,328.918,470.08,278.641,470.08z" ng-click="aplicar_tratamiento_down(l7175)" 
								   	ng-style="{'fill': l7175.abajo_color != '' ? l7175.abajo_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_5">
						              <path class="izquierda" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" d="M88.72,280.161c0-50.28,19.436-97.567,54.757-133.287L89.32,92.716
						                c-47.765,48.16-77.314,114.417-77.314,187.445c0,73.024,29.549,139.285,77.316,187.441l54.156-54.154
						                C108.156,377.723,88.72,330.436,88.72,280.161z" ng-click="aplicar_tratamiento_left(l7175)"
								   ng-style="{'fill': l7175.izquierda_color != '' ? l7175.izquierda_color : 'rgb(255,255,255)'}" />
						            </g>
						            <g id="Capa_6">
						              <circle class='center' style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" cx="278.902" cy="279.699" r="187.352" ng-click="aplicar_tratamiento_center(l7175)"
								  ng-style="{'fill': l7175.centro_color != '' ? l7175.centro_color : 'rgb(255,255,255)'}" />
						            </g>
						          </g>
						        </switch>

						        </svg>
                			</td>
                			<td></td>
                			<td></td>
                		</tr>

                		<tr>
                			<td></td>
                			<td></td>
                			<td></td>
                			<td ng-repeat=" l8581 in odontograma.lingual8581 " >
                				<img ng-repeat=" tr in l8581.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
                			</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td></td>
                			<td></td>
                			<td ng-repeat=" l7175 in odontograma.lingual7175 " >
                				<img ng-repeat=" tr in l7175.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
                			</td>
                			<td></td>
                			<td></td>
                		</tr>

                		

                		<tr>
                			<td></td>
                			<td ng-repeat=" v4841 in odontograma.vestibular4841 ">{{v4841.id_numero}}</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td ng-repeat=" v3138 in odontograma.vestibular3138 ">{{v3138.id_numero}}</td>
                		</tr>

                		<tr>
                			<th>Vestibular</th>
                			<td ng-repeat=" v4841 in odontograma.vestibular4841 " >
                				<svg xmlns="http://www.w3.org/2000/svg"  version="1.1" style="height: 50px; width: 40px;" viewBox="0 0 194 186"  width="150" height="150">  
								  <polygon points="100,50  150,20  150,20  0,20  50,50"
								  	class="arriba"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_up(v4841)" 
								   ng-style="{'fill': v4841.arriba_color != '' ? v4841.arriba_color : 'rgb(255,255,255)'}"  />

								  <rect x="50" y="50" width="50" height="50" 
								  class="center"
								  style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)"  ng-click="aplicar_tratamiento_center(v4841)"
								  ng-style="{'fill': v4841.centro_color != '' ? v4841.centro_color : 'rgb(255,255,255)'}" />

								  <polygon points="100,100 50,100 0,130  0,130  150,130"
								  	class="abajo"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_down(v4841)" 
								   	ng-style="{'fill': v4841.abajo_color != '' ? v4841.abajo_color : 'rgb(255,255,255)'}"  />

								   <polygon points="100,100 100,50 150,20 150,130  150,130"
								  	class="derecha"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_right(v4841)"
								   ng-style="{'fill': v4841.derecha_color != '' ? v4841.derecha_color : 'rgb(255,255,255)'}" />

								   <polygon points="50,100 50,50 0,20 0,130  0,130"
								  	class="izquierda"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_left(v4841)"
								   ng-style="{'fill': v4841.izquierda_color != '' ? v4841.izquierda_color : 'rgb(255,255,255)'}" />
								</svg>
                			</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td ng-repeat=" v3138 in odontograma.vestibular3138 " >
                				<svg xmlns="http://www.w3.org/2000/svg"  version="1.1" style="height: 50px; width: 40px;" viewBox="0 0 194 186"  width="150" height="150">  
								  <polygon points="100,50  150,20  150,20  0,20  50,50"
								  	class="arriba"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_up(v3138)" 
								   ng-style="{'fill': v3138.arriba_color != '' ? v3138.arriba_color : 'rgb(255,255,255)'}"  />

								  <rect x="50" y="50" width="50" height="50" 
								  class="center"
								  style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_center(v3138)"
								  ng-style="{'fill': v3138.centro_color != '' ? v3138.centro_color : 'rgb(255,255,255)'}"  />

								  <polygon points="100,100 50,100 0,130  0,130  150,130"
								  	class="abajo"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_down(v3138)" 
								   	ng-style="{'fill': v3138.abajo_color != '' ? v3138.abajo_color : 'rgb(255,255,255)'}" />

								   <polygon points="100,100 100,50 150,20 150,130  150,130"
								  	class="derecha"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_right(v3138)"
								   ng-style="{'fill': v3138.derecha_color != '' ? v3138.derecha_color : 'rgb(255,255,255)'}"  />

								   <polygon points="50,100 50,50 0,20 0,130  0,130"
								  	class="izquierda"
								   style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)" ng-click="aplicar_tratamiento_left(v3138)"
								   ng-style="{'fill': v3138.izquierda_color != '' ? v3138.izquierda_color : 'rgb(255,255,255)'}"/>
								</svg>
                			</td>
                		</tr>
                		<tr>
                			<td></td>
                			<td ng-repeat=" v4841 in odontograma.vestibular4841 ">
                				<img ng-repeat=" tr in v4841.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
                			</td>
                			<td style="width: 25px;"></td>
							<td style="width: 25px;"></td>
							<td ng-repeat=" v3138 in odontograma.vestibular3138 ">
								<img ng-repeat=" tr in v3138.tratamiento track by $index " ng-cloak src="/upload/Odontologia/Tratamientos/{{tr}}.png" />
							</td>
                		</tr>
                		<tr>
                			<th>Movilidad</th>
                			<td ng-repeat=" v4841 in odontograma.vestibular4841 "><input type="text" style="width: 40px;" ng-model=" v4841.text2" class="form-control" name=""></td>
                			<td style="width: 25px;"></td>
                			<td style="width: 25px;"></td>
                			<td ng-repeat=" v3138 in odontograma.vestibular3138 "><input type="text" style="width: 40px;" ng-model=" v3138.text2" class="form-control" name=""></td>
                		</tr>
                		<tr>
                			<th>Recesión</th>
                			<td ng-repeat=" v4841 in odontograma.vestibular4841 "><input type="text" style="width: 40px;" ng-model=" v4841.text1" class="form-control" name=""></td>
                			<td style="width: 25px;"></td>
                			<td style="width: 25px;"></td>
                			<td ng-repeat=" v3138 in odontograma.vestibular3138 "><input type="text" style="width: 40px;" ng-model=" v3138.text1" class="form-control" name=""></td>
                		</tr>
                	</table>

                </div>
                <!-- ODONTOGRAMA PARTE DEL FORMULARIO 033-->



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

    <div class="modal fade" id="finalizarcita" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Información</h4>
                </div>
                <div class="modal-body">
                    <h5><strong>Esta seguro de finalizar la cita?</strong></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i>Cancelar</button>
                    <button type="button" class="btn btn-primary btn-sm" ng-click="end_citaok();"><i class="glyphicon glyphicon-floppy-saved"></i> Finalizar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="vademecum_information" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Vademecum</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" placeholder="Buscar " ng-keyup="pageChanged_vademecum(1);" name="buscar_medicamento" ng-model="buscar_medicamento" id="buscar_medicamento">
                                <span class="input-group-btn">
			                        <button class="btn btn-default btn-sm" ng-click="pageChanged_vademecum(1);" type="button">Buscar</button>
			                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12 table-responsive">
                            <table class="table table-condensend table-bordered " >
                                <thead>
                                <tr class="bg-primary">
                                    <th></th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Presentacion</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="font-size: 10px !important;" dir-paginate="u in lis_vademecum | orderBy:sortKey:reverse |filter:buscar_medicamento| itemsPerPage:5" total-items="totalItemsvademe" ng-cloak">
                                <td >{{$index+1}}</td>
                                <td >{{u.codigo}}</td>
                                <td >{{u.descripcion}}</td>
                                <td >{{u.presentacion}}</td>
                                <td >
                                    <div class="btn-group" role="group" >
                                        <button  ng-click="select_vademecum(u);" type="button" title="Seleccionar" class="btn btn-sm btn-info">
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                        </button>
                                    </div>
                                </td>
                                </tr>
                                </tbody>
                            </table>
                            <dir-pagination-controls
                                    on-page-change="pageChanged_vademecum(newPageNumber)"
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
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i>Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="cie_information" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cie 10</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" placeholder="Buscar " ng-keyup="pageChanged_cie(1);" name="buscar_cie10" ng-model="buscar_cie10" id="buscar_cie10">
                                <span class="input-group-btn">
			                        <button class="btn btn-default btn-sm" ng-click="pageChanged_cie(1);" type="button">Buscar</button>
			                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12 table-responsive">
                            <table class="table table-condensend table-bordered " >
                                <thead>
                                <tr class="bg-primary">
                                    <th></th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="font-size: 10px !important;" dir-paginate="u in lis_cie10 | orderBy:sortKey:reverse |filter:buscar_cie10| itemsPerPage:5" total-items="totalItemscie" ng-cloak">
                                <td >{{$index+1}}</td>
                                <td >{{u.codigo}}</td>
                                <td >{{u.descripcion}}</td>
                                <td >
                                    <div class="btn-group" role="group" >
                                        <button  ng-click="select_cie10(u);" type="button" title="Seleccionar" class="btn btn-sm btn-info">
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                        </button>
                                    </div>
                                </td>
                                </tr>
                                </tbody>
                            </table>
                            <dir-pagination-controls
                                    on-page-change="pageChanged_cie(newPageNumber)"
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
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i>Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->






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
      						<th>CI. Cli.</th>
      						<!--<th>Usuario</th>-->
      						<th>Fecha</th>
      						<th>Hora</th>
      						<th>Turno</th>
      						<th>Descripción</th>
      						<th>Estado</th>
      						<th>Tipo</th>
      						<th></th>
      					</tr>
      				</thead>
      				<tbody>
      					<tr ng-repeat=" ci in list_info_day " style="font-size: 11px !important;">
      						<td>{{$index+1}}</td>
      						<td>{{ci.empleado.persona.apellido+' '+ci.empleado.persona.nombre}}</td>
      						<td>{{ci.cliente.persona.apellido+' '+ci.cliente.persona.nombre}}</td>
      						<td>{{ci.cliente.persona.ci}}</td>
      						<!--<td>{{ci.usuario.persona.apellido+' '+ci.usuario.persona.nombre}}</td>-->
      						<td>{{ci.fecha}}</td>
      						<td>{{ci.horainicio}}</td>
      						<td>{{ci.turno}}</td>
      						<td>{{ci.observacion}}</td>
      						<!--<td>{{ci.gestion}}</td>-->

							<td ng-hide="ci.gestion==1 " style="background-color: #009688;">{{((ci.gestion==1)?"PENDIENTE":"FINALIZADA")}}</td>
		      				<td ng-hide="ci.gestion!=1 " style="background-color: #bbdefb; ">{{((ci.gestion==1)?"PENDIENTE":"FINALIZADA")}}</td>

      						<td ng-hide="ci.tipo==1 " style="background-color: #f44336 ">{{((ci.tipo==1)?"NORMAL":"EMERRGENCIA")}}</td>
      						<td ng-hide="ci.tipo!=1 " style="background-color: #80cbc4 ">{{((ci.tipo==1)?"NORMAL":"EMERRGENCIA")}}</td>

      						<td>{{((ci.estado==1)? "ACTIVA":"INACTIVA")}}</td>

      					</tr>
      				</tbody>
      			</table>
      		</div>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
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
							<td>{{calcular_edad(u.persona.fechan)}}</td>
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