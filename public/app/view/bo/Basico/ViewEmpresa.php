<div class="row" ng-init="permisos_user();" ng-cloak>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>

	<div class="row">
	<form class="form-horizontal"  name="frmemp" id="frmemp"  novalidate="">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Nombre</span>
				  <input type="text" class="form-control input-sm" id="nombre" name="nombre" ng-model="nombre" required />
				</div>
				<span class="help-block error" ng-show="frmemp.nombre.$invalid && frmemp.nombre.$touched">El nombres es requerido</span>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> RUC</span>
				  <input type="text" class="form-control input-sm" id="ruc" name="ruc" ng-model="ruc" />
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> País</span>
				  <select  class="form-control input-sm" id="id_pa" name="id_pa" ng-model="id_pa"  required >
				  		<option value="">Seleccione</option>
				  		<option ng-repeat=" p in list_pais " value="{{p.id_pa}}">{{p.descripcion}}</option>
				  </select>
				</div>
				<span class="help-block error" ng-show="frmemp.id_pa.$invalid && frmemp.id_pa.$touched">El pais es requerido</span>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Provincia</span>
				  <select  class="form-control input-sm" id="id_pro" name="id_pro" ng-model="id_pro"  required >
				  		<option value="">Seleccione</option>
				  		<option ng-repeat=" p in list_provincia " value="{{p.id_pro}}">{{p.descripcion}}</option>
				  </select>
				</div>
				<span class="help-block error" ng-show="frmemp.id_pro.$invalid && frmemp.id_pro.$touched">La provincia es requerida</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Ciudad</span>
				  <select  class="form-control input-sm" id="id_ci" name="id_ci" ng-model="id_ci" required >
				  		<option value="">Seleccione</option>
				  		<option ng-repeat=" c in list_ciudad " value="{{c.id_ci}}">{{c.descripcion}}</option>
				  </select>
				</div>
				<span class="help-block error" ng-show="frmemp.id_ci.$invalid && frmemp.id_ci.$touched">La ciudad es requerida</span>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Dirección</span>
				  <input type="text" class="form-control input-sm" id="direccion" name="direccion" ng-model="direccion" required />
				</div>
				<span class="help-block error" ng-show="frmemp.direccion.$invalid && frmemp.direccion.$touched">La dirección es requerida</span>
			</div>

		</div>

		<div class="row" >
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Teléfono : </span>
					<input type="text" class="form-control input-sm" name="telefono" id="telefono" ng-model="telefono" required />
				</div>
				<span class="help-block error" ng-show="frmemp.telefono.$invalid && frmemp.telefono.$touched">El teléfono es requerido</span>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Logo: </span>
					<input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
				</div>
				<span class="help-block error" ng-show="frmemp.file.$error.pattern">El archivo debe ser Imagen</span>
				<span class="help-block error" ng-show="frmemp.file.$error.maxSize">El tamaño máximo es de 2 MB </span>

				<img class="img-thumbnail" ngf-src="file || url_foto"  alt="" style="width: 50%;">
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" >
					<!--<button type="button" class="btn btn-success btn-sm">
						<i class="glyphicon glyphicon-floppy-saved"></i>
						Guardar
					</button>-->
					<button type="button" class="btn btn-primary btn-sm" ng-disabled=" list_permisos.access_edit==0 || frmemp.$invalid " ng-click="edit()">
						<i class="glyphicon glyphicon-floppy-saved"></i>
						Guardar
					</button>
					<!--<button type="button" class="btn btn-default btn-sm">
						<i class="glyphicon glyphicon-ban-circle"></i>
						Cancelar
					</button>-->
				</div>
			</div>
		</div>
	</form>	
	</div>

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