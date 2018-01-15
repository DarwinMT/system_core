<div class="row" ng-cloak>
	<div class="row">
		<div class="col m12 s12">
				<h5 class="header"><strong>{{Title}}</strong></h5>
				<hr>
		</div>
	</div>

<div class="row">
	<form class="form-horizontal"  name="frm_agenda" id="frm_agenda"  novalidate="" >
		<div class="col m12 s12 ">
          	<select class="browser-default" ng-change="make_time();"  name="tipoagenda" id="tipoagenda" ng-model="tipoagenda" required>
				<option value="1">Normal</option>
				<option value="2">Emergencia</option>
			</select>
			<span class="help-block error" ng-show="frm_agenda.tipoagenda.$invalid && frm_agenda.tipoagenda.$touched"> El tipo de ageanda es requerido</span>
		</div>

		<div class="col m12 s12 input-field">
			<i class="material-icons prefix">face</i>
          	<input type="text" class="" readonly name="nombrecliente" id="nombrecliente" ng-model="nombrecliente" required />
          	<span class="help-block error" ng-show="frm_agenda.nombrecliente.$invalid && frm_agenda.nombrecliente.$touched">El Cliente es requerido</span>
		</div>

		<div class="col m12 s12 input-field">
			<i class="material-icons prefix">date_range</i>
          	<input type="date" class=" ng-pristine ng-valid ng-empty ng-touched" name="fechacita" id="fechacita" ng-model="fechacita" required>
          	<span class="help-block error" ng-show="frm_agenda.fechacita.$invalid && frm_agenda.fechacita.$touched">La fecha es requerida</span>
		</div>
		
		<div class="col m12 s12 input-field">
			<select class="browser-default"  name="hora" id="hora" ng-model="hora" required>
				<option value="">Seleccione</option>
				<option ng-repeat=" t in horas_general" value="{{t}}">{{t}}</option>
			</select>
			<span class="help-block error" ng-show="frm_agenda.hora.$invalid && frm_agenda.hora.$touched">La hora es requerida</span>
		</div>


		<div class="col m12 s12 input-field">
			<i class="material-icons prefix">insert_comment</i>
          	<input type="text" class="" name="observacion" id="observacion" ng-model="observacion">
		</div>

		<div class="fixed-action-btn horizontal">
			 <button type="button" class="btn-floating btn-large waves-effect waves-light " title="Agendar Cita"><i class="material-icons">add</i></button>    
		</div>
	</form>	
</div>


</div>