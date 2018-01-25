<div class="row" ng-cloak>

 <div id="md_cliente" class="modal">
    <div class="modal-content">
      <h5><strong>Buscar Cliente</strong></h5>
      <hr>

      <div class="row">
      		<div class="col m10 s10 ">
      			<div class="input-group">
			      <input type="text" class="form-control input-sm"  placeholder="Buscar " name="buscartexto_cliente" ng-model="buscartexto_cliente" id="buscartexto_cliente">
			    </div>
      		</div>
      		<div class="col m2 s2">
      			<a class="btn-floating  waves-effect waves-light  blue " ng-click="pageChanged_cliente(1)" ><i class="material-icons">search</i></a>
      		</div>
      	</div>

      	<div class="row">
      		<div class="col m12 s12">
      			<table class="table highlight bordered raaesponsive-table">
      				<thead>
      					<tr > 
      						<th>DNI</th>
      						<th>Cliente</th>
      						
      						<th></th>
      					</tr>
      				</thead>
      				<tbody >
						<tr dir-paginate="u in list_cliente | orderBy:sortKey:reverse |filter:buscartexto_cliente| itemsPerPage:5" total-items="totalItems" ng-cloak">
							<td>{{u.persona.ci}}</td>
							<td>{{u.persona.apellido+" "+u.persona.nombre}}</td>
							<td>
								<div class="btn-group" role="group" >
									<button  ng-click="select_cliente(u);" type="button" title="Editar" class="waves-effect waves-light btn">
										<i class="material-icons">send</i>
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
    </div>
</div>



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
			<i class="material-icons prefix" ng-click="buscar_cliente();">face</i>
          	<input type="text" class="" disabled  name="nombrecliente" id="nombrecliente" ng-model="nombrecliente" required />
          	<span class="help-block error" ng-show="frm_agenda.nombrecliente.$invalid && frm_agenda.nombrecliente.$touched">El Cliente es requerido</span>
		</div>

		<div class="col m12 s12 input-field">
			<i class="material-icons prefix">date_range</i>
          	<input type="date" class=" ng-pristine ng-valid ng-empty ng-touched" name="fechacita" id="fechacita" ng-model="fechacita" required>
          	<span class="help-block error" ng-show="frm_agenda.fechacita.$invalid && frm_agenda.fechacita.$touched">La fecha es requerida</span>
		</div>
		
		<div class="col m12 s12">
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

		<!--<div class="fixed-action-btn horizontal">
			 <button type="button" class="btn-floating btn-large waves-effect waves-light " title="Agendar Cita"><i class="material-icons">add</i></button>    
		</div>-->
	  <div class="fixed-action-btn  click-to-toggle">
	    <a class="btn-floating btn-large ">
	      <i class="material-icons">menu</i>
	    </a>
	    <ul>
	      <li>
	      	<a class="btn-floating green tooltipped" onclick="$('#modal1').modal('open')" title="Guardar Cita" data-position="left" data-delay="50" data-tooltip="Guardar Cita" >
	      		<i class="material-icons">save</i>
	      	</a>
	      </li>
	      
	      <li>
	      	<a class="btn-floating red tooltipped" ng-click="limpiar_cliente()" title="Quitar Cliente" data-position="left" data-delay="50" data-tooltip="Quitar Cliente" >
	      		<i class="material-icons">delete</i>
	      	</a>
	      </li>
	    </ul>
	  </div>

	</form>	
</div>




</div>