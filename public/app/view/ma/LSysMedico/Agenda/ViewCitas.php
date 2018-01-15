<div class="row" ng-cloak>
	<div class="row">
		<div class="col m12 s12">
				<h5 class="header"><strong>{{Title}}</strong></h5>
				<hr>
		</div>
	</div>

	<div class="row">
		<div class="col m12 s12 input-field">
			<i class="material-icons prefix">date_range</i>
          	<input  type="date" class="" placeholder="Fecha de inicio" id="fecha_desde" name="fecha_desde" ng-model="fecha_desde">
          	<label for="fecha_desde"></label>
		</div>
	</div>

	<div class="row">
		<div class="col m12 s12 input-field">
			<i class="material-icons prefix">date_range</i>
          	<input  type="date" class="" placeholder="Fecha de fin" id="fecha_hasta" name="fecha_hasta" ng-model="fecha_hasta">
          	<label for="fecha_hasta"></label>
		</div>
	</div>

	<div class="row">
		<div class="col m12 s12">
			<table class="bordered striped highlight responsive-table">
				<thead class="">
					<tr>
						<th></th>
						<th>Cliente</th>
						<th>CI. CL.</th>
						<th>Fecha|Hora</th>
						<th>Turno</th>
						<th>Descripción</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat=" c in list_agenda">
						<td>{{$index+1}}</td>
						<td>{{c.cliente.persona.apellido+' '+c.cliente.persona.nombre}}</td>
						<td>{{c.cliente.persona.ci+' | '+c.cliente.numerohistoria}}</td>
						<td>{{c.fecha+' | '+c.horainicio}}</td>
						<td>{{c.turno}}</td>
						<td>{{c.observacion}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>


   <div class="fixed-action-btn horizontal click-to-toggle">
    <a class="btn-floating btn-large waves-effect waves-light " ng-click="getcitas();">
    	<i class="material-icons">search</i>
    </a>
  </div>
</div>