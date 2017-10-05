
<div class="row" ng-init="permisos_user();" ng-cloak>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}}</strong></h3>
			<hr>
		</div>
	</div>

	<div >
		<div class="row" >
			<div class="col-md-1 col-xs-6">
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
			<div class="col-md-5 col-xs-12">
				<div class="btn-group" >
					<button type="button" ng-click="back_calendar();" class="btn btn-primary btn-sm">
							<i class="glyphicon glyphicon-backward "></i> Atras
					</button>
					
					<button type="button" ng-click="nex_calendar();" class="btn btn-primary btn-sm">
							<i class="glyphicon glyphicon-forward "></i> Adelante
					</button>

					<button type="button" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-calendar "></i> Año</button>
					<button type="button" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-calendar "></i> Mes</button>
					<button type="button" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-calendar "></i> Semana</button>
					<button type="button" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-calendar "></i> Dia</button>
				</div>
			</div>

			<div class="col-md-2 col-xs-12">
				<div class="input-group ">
					<span class="btn btn-sm input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar "></i>  </span>
					<input type="text" class="form-control input-sm" name="descripcion" id="nombre" ng-model="descripcion" required />
					<span class="input-group-btn">
			        	<button class="btn btn-default btn-sm" type="button"><i class="glyphicon glyphicon-search"></i></button>
			      	</span>
				</div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="input-group ">
					<span class="btn btn-sm input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar "></i> Desde  </span>
					<input type="text" class="form-control input-sm" name="descripcion" id="nombre" ng-model="descripcion" required />
					<span class="btn btn-sm input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar "></i> Hasta  </span>
					<input type="text" class="form-control input-sm" name="descripcion" id="nombre" ng-model="descripcion" required />
					<span class="input-group-btn">
			        	<button class="btn btn-default btn-sm" type="button"><i class="glyphicon glyphicon-search"></i></button>
			      	</span>
				</div>
			</div>

		</div>


		<div class="row">
			
		</div>

		<div class="row" id="mes">
			<div class="col-md-12 col-xs-12">
				<table class="table table-bordered table-condensend">
					<thead>
						<tr class="bg-primary">
							<th colspan="7" class="text-center">{{Fecha_Select}}</th>
						</tr>
						<tr class="bg-primary">
							<th style="width: 100px;">Domingo</th>
							<th style="width: 100px;">Lunes</th>
							<th style="width: 100px;">Martes</th>
							<th style="width: 100px;">Miercoles</th>
							<th style="width: 100px;">Jueves</th>
							<th style="width: 100px;">Viernes</th>
							<th style="width: 100px;">Sabado</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="m in mes">
							<td ng-repeat="d in m" style="height: 100px;">
								<div class="row">
									<div class="col-xs-6">
										<button onclick="$('#citas').modal('show');" class="btn btn-sm btn-success"><span class="badge" >{{d.Numero_Citas}}</span></button>
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

	</div>










<div class="modal fade" id="citas" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



</div>