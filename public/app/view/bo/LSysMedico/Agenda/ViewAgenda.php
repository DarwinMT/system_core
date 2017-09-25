
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
					<button type="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-backward "></i> Atras</button>
					<button type="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-forward "></i> Adelante</button>
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
							<th>Lunes</th>
							<th>Martes</th>
							<th>Miercoles</th>
							<th>Jueves</th>
							<th>Viernes</th>
							<th>Sabado</th>
							<th>Domingo</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

</div>