<div class="row" ng-init="permisos_user();" ng-cloak>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="input-group ">
				<span class="btn btn-sm input-group-addon">
					<i class="glyphicon glyphicon-calendar "></i> Desde 
				</span>
				<input type="text" class="form-control input-sm datepicker" name="fecha_desde" id="fecha_desde" ng-model="FechaI" required />
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="input-group ">
				<span class="btn btn-sm input-group-addon">
					<i class="glyphicon glyphicon-calendar "></i> Hasta 
				</span>
				<input type="text" class="form-control input-sm datepicker" name="fecha_hasta" id="fecha_hasta" ng-model="FechaF" required />
			</div>
		</div>
		<div class="col-md-4 col-xs-12">
			<button type="button" class="btn btn-sm btn-primary" ng-click="call_all_and_getdatos();">
				<i class="glyphicon glyphicon-search"></i>
				Buscar
			</button>
		</div>
	</div>
	<di class="row">
		<div class="col-md-6 col-xs-12">
			<canvas id="number_citas"></canvas>
		</div>
		<div class="col-md-6 col-xs-12">
			<canvas id="number_enfermedadgenerales"></canvas>
		</div>
	</di>

	<di class="row">
		<div class="col-md-6 col-xs-12">
			<canvas id="number_diagnosticos"></canvas>
		</div>
		<div class="col-md-6 col-xs-12">
			<canvas id="number_medicamentos"></canvas>
		</div>
	</di>

</div>